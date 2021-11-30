<?php

namespace Neeraj1005\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class CmsSeo extends Model
{
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

    protected $appends = ['profile_img', 'meta_title', 'meta_description'];

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
