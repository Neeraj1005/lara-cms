<?php

namespace Neeraj1005\Cms\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes, HasSlug;

    //Table Name
    protected $table = 'cms_posts';

    //Primary key
    public $primaryKey = 'id';

    protected $fillable = [
        'title',
        'slug',
        'body',
        'picture',
        'user_id',
        'cms_category_id',
        'published',
        'views',
        'isActive',
        'isFeatured',
        'needComments',
    ];

    const POST_PAGINATE = 10;
    const TYPE_PUBLISHED = 'published';
    const TYPE_DRAFT = 'draft';
    const TYPE_TRASH = 'trashed';

    protected $appends = ['profile_img'];

    public function getProfileImgAttribute()
    {
        return $this->picture ? asset('public/storage/' . $this->picture) : null;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function profileImage()
    {
        if (config('cms.asset_url')) {
            return $this->picture ? 'public/storage/' . $this->picture : null;
        }

        return $this->picture ? 'storage/' . $this->picture : null;
    }

    public function stringLimit(string $val, int $len = 128)
    {
        return $val ? Str::limit($val, $len, '...') : null;
    }

    public function ScopeIsPublished($query)
    {
        return $query->where('published', true);
    }

    public function ScopeIsDraft($query)
    {
        return $query->where('published', false);
    }

    public function ScopeIsTrashed()
    {
        return $this->onlyTrashed();
    }

    public function getSummaryOfBodyAttribute()
    {
        if ($this->body) {
            $body =  Str::limit(strip_tags($this->body), 156, '...');
            return $body;
        } else {
            return null;
        }
    }


    // relation function below

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    public function cms_category()
    {
        return $this->belongsTo(CmsCategory::class, 'cms_category_id');
    }

    public function cms_tags()
    {
        return $this->belongsToMany(CmsTag::class, 'cms_post_tag', 'cms_post_id', 'cms_tag_id');
    }

    public function posts_tags()
    {
        $tags = $this->cms_tags()->get()->map(function ($tag) {
            return $tag->name;
        })->implode(',');

        if ($tags == '') return '';

        return $tags;
    }

    public function ScopeAuthUser($query)
    {
        return $query->where('user_id', auth()->id());
    }
}
