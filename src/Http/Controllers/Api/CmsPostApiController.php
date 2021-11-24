<?php

namespace Neeraj1005\Cms\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Neeraj1005\Cms\Models\Post;
use Illuminate\Routing\Controller;

class CmsPostApiController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'limit' => ['nullable', 'integer'],
        ]);

        $posts = Post::query();

        if ($request->limit) {
            $posts = Post::with('cms_category:id,name,slug')->isPublished()->latest()->take($request->limit)->get();
        } else {
            $posts = Post::with('cms_category:id,name,slug')->isPublished()->latest()->paginate(Post::POST_PAGINATE);
        }

        return response()->json([
            'posts' => $posts,
        ], Response::HTTP_OK);
    }

    public function show(Post $post)
    {
        $posts = $post->with('cms_category:id,name,slug')->isPublished()->findOrFail($post->id);

        return response()->json([
            'posts' => $posts,
        ], Response::HTTP_OK);
    }
}
