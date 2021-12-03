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

    public function registerMediaConversions(Media $media = null): void
    {
        // $this
        //     ->addMediaConversion('preview')
        //     ->fit(Manipulations::FIT_CROP, 300, 300)
        //     ->acceptsMimeTypes(['image/jpeg/png/'])
        //     ->nonQueued();

        $this
            ->addMediaCollection(self::MEDIA_COLLECTION_NAME)
            ->acceptsMimeTypes(['image/jpeg/png/']);
    }
}
