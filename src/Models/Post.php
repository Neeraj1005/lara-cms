<?php

namespace Neeraj1005\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;

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

    public function cms_category()
    {
        return $this->belongsTo(CmsCategory::class, 'cms_category_id');
    }

}
