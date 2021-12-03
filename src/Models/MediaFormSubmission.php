<?php

namespace Neeraj1005\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaFormSubmission extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    const MEDIA_COLLECTION_NAME = 'media_manager';
    const MEDIA_CONVERSION_NAME = 'media_thumb';

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
}
