<?php

namespace Neeraj1005\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Neeraj1005\Cms\Models\CmsSeo;

class CmsSeoController extends Controller
{
    public function seoStore(Request $request)
    {
        $validatedData = $request->validate([
            'site_title' => ['nullable', 'string', 'max:150'],
            'site_description' => ['nullable', 'string', 'max:255'],
            'picture' => ['nullable', 'image', 'max:1024'],
        ]);
        try {
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $path_url = $file->storePublicly('cms/logo', 'public');
                $validatedData['logo'] = $path_url;
            }

            $cmsSeo = CmsSeo::updateOrCreate(['id' => CmsSeo::ROW_ID], $validatedData);

            if ($request->hasFile('picture')) {
                
                // if media has already a logo then delete previous one and upload new one
                if ($cmsSeo->getFirstMedia(CmsSeo::MEDIA_COLLECTION_NAME)) {
                    $cmsSeo->clearMediaCollection(CmsSeo::MEDIA_COLLECTION_NAME);
                }

                $cmsSeo->addMedia($request->picture)
                    ->withResponsiveImages()
                    ->toMediaCollection(CmsSeo::MEDIA_COLLECTION_NAME);
            }

            return redirect()->route('cms.settings')->with('message', 'data added successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'something went wrong! ' . $th->getMessage());
        }
    }
}
