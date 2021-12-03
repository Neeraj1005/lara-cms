<?php

namespace Neeraj1005\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Neeraj1005\Cms\Models\MediaFormSubmission;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CmsMediaController extends Controller
{
    public function index()
    {
        $mediaLib = Media::paginate(10);
        return view('cms::mediamanager.index', compact('mediaLib'));
    }

    public function create()
    {
        return view('cms::mediamanager.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'media' => ['required', 'image'],
        ]);

        try {
            DB::transaction(function () use ($request) {
                $mediaFormSubmission = MediaFormSubmission::create([
                    'name' => $request->name ?? 'filemanager',
                ]);

                $mediaFormSubmission->addMedia($request->media)
                    ->withResponsiveImages()
                    ->toMediaCollection(MediaFormSubmission::MEDIA_COLLECTION_NAME);
            });
            return redirect()->route('cms.media.index')->with('message', 'media uploaded successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'error: ' . $th->getMessage());
        }
    }

    public function show()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
