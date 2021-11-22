<?php

namespace Neeraj1005\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Neeraj1005\Cms\Models\Post;
use Illuminate\Routing\Controller;

class CmsHomeController extends Controller
{
    public function index()
    {
        $posts = Post::isPublished()->latest()->paginate(config('cms.paginated_data'));

        return view('cms::cms-home', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->increment('views');
        return view('cms::cms-view', compact('post'));
    }
}
