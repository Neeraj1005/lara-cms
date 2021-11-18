<?php

namespace Neeraj1005\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Neeraj1005\Cms\Models\Post;

class CmsHomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(config('cms.paginated_data'));

        return view('cms::cms-home', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('cms::cms-view', compact('post'));
    }
}
