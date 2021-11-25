<?php

namespace Neeraj1005\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Neeraj1005\Cms\Models\Post;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CmsReportController extends Controller
{
    public function index()
    {
        try {

            $totalPosts = Post::isPublished()->get();
            for ($i = 0; $i <= 30; $i++) {
                $date = date('Y-m-d', strtotime('today - ' . $i . ' days'));
                $postData = DB::table('cms_posts')
                    ->select(DB::raw('count(id) as post'))
                    ->where('published', 1)
                    ->where(DB::raw('DATE(created_at)'), $date)
                    ->first();
    
                $labels[] = date('d M', strtotime($date));
                $data[] = $postData->post;
            }

            return view('cms::posts.reports', compact('data', 'labels', 'totalPosts'));
        } catch (\Throwable $th) {
            //
        }

    }
}
