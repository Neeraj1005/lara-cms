<?php

namespace Neeraj1005\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        'user_id',
        'category_id',
        'body',
        'published',
        'subcategory_id',
        'postcount',
        'isactive',
        'featured',
        'commentActive',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
