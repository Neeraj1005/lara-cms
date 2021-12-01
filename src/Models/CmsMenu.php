<?php

namespace Neeraj1005\Cms\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class CmsMenu extends Model
{
    use HasSlug;

    protected $table = 'cms_menus';

    //Primary key
    public $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'placed_in',
        'order_column',
        'is_active',
        'url',
        'is_checked',
    ];

    protected $casts = [
        'is_checked' => 'boolean',
        'is_active' => 'boolean',
    ];

    const MENU_PAGINATE = 10;
    const HEADER_MENU = 1;
    const FOOTER_MENU = 0;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    private static function getHighestOrderNumber()
    {
        return (int) self::max('order_column');
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->order_column = self::getHighestOrderNumber() + 1;
            $model->save();
        });
    }
}
