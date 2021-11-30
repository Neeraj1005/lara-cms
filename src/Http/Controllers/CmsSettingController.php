<?php

namespace Neeraj1005\Cms\Http\Controllers;

use Illuminate\Routing\Controller;
use Neeraj1005\Cms\Models\CmsSeo;

class CmsSettingController extends Controller
{
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $seo = CmsSeo::first();

        return view('cms::settings.cms-setting', compact('seo'));
    }
}
