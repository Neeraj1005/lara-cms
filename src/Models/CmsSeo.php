<?php

namespace Neeraj1005\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CmsSeo extends Model implements HasMedia
{
    use InteractsWithMedia;

    //Table Name
    protected $table = 'cms_seos';

    //Primary key
    public $primaryKey = 'id';

    protected $fillable = [
        'site_title',
        'site_description',
        'logo',
    ];

    const ROW_ID = 1;
    const MEDIA_COLLECTION_NAME = 'seo_manager';
    const MEDIA_CONVERSION_NAME = 'seo_thum';

    protected $appends = ['profile_img', 'meta_title', 'meta_description'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion(self::MEDIA_CONVERSION_NAME)
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection(self::MEDIA_COLLECTION_NAME);
            // ->acceptsMimeTypes(['image/jpeg/png/']);
    }

    public function getProfileImgAttribute()
    {
        if (config('cms.asset_url')) {
            return $this->logo ? asset('public/storage/' . $this->logo) : null;
        }

        return $this->logo ? asset('storage/' . $this->logo) : null;
    }

    public function getMetaTitleAttribute()
    {
        return $this->site_title ? $this->site_title : config('app.name');
    }

    public function getMetaDescriptionAttribute()
    {
        return $this->site_description ? $this->site_description : config('cms.description');
    }
}
