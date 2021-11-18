<?php

namespace Neeraj1005\Cms\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsCategory extends Model
{
    use HasFactory, HasSlug;

    //Table Name
    protected $table = 'cms_categories';

    //Primary key
    public $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function cms_posts()
    {
        return $this->hasMany(Post::class, 'cms_category_id');
    }
}
