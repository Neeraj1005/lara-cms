<?php

namespace Neeraj1005\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Neeraj1005\Cms\Models\Post;
use Illuminate\Routing\Controller;
use Neeraj1005\Cms\Models\CmsCategory;

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

    public function rssFeed(Request $request)
    {
        abort_if($request->q != 'latest-post', 403);

        if ($request->q == 'latest-post') {
            $latestPosts = Post::isPublished()->latest()->take(20)->get();

            $content = view('cms::latest-rss-feed', compact('latestPosts'));

            return response($content, Response::HTTP_OK)->header('Content-Type', 'text/xml');
        }
    }

    public function sitemap()
    {
        $categoriesHasPost = CmsCategory::whereHas('cms_latest_posts', function($query){
            $query->isPublished();
        })->take(10)->get();

        return view('cms::sitemap', compact('categoriesHasPost'));
    }
}
