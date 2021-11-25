<?php

namespace Neeraj1005\Cms\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class CmsTag extends Model
{
    use HasSlug;

    //Table Name
    protected $table = 'cms_tags';

    //Primary key
    public $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
    ];

    const TAG_PAGINATE = 5;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
