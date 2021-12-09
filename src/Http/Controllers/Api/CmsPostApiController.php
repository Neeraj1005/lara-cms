<?php

namespace Neeraj1005\Cms\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Neeraj1005\Cms\Models\Post;
use Illuminate\Routing\Controller;
use Neeraj1005\Cms\Http\Library\CmsPostLibrary;

class CmsPostApiController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'limit' => ['nullable', 'integer'],
        ]);
        try {
            $postLib = new CmsPostLibrary;

            if ($request->limit) {
                $posts = $postLib->postLists($request->limit);
            } else {
                $posts = $postLib->postLists();
            }
            return response()->json([
                'posts' => $posts,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'something went wrong. ' . $th->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function show(Post $post)
    {
        $posts = $post->with('media', 'cms_category:id,name,slug', 'cms_tags', 'user:id,name')
            ->withCount('cms_tags', 'cms_category')
            ->isPublished()
            ->findOrFail($post->id);

        return response()->json([
            'posts' => $posts,
        ], Response::HTTP_OK);
    }
}
