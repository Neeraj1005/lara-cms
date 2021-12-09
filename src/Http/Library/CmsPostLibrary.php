<?php

namespace Neeraj1005\Cms\Http\Library;

use Neeraj1005\Cms\Models\Post;

class CmsPostLibrary
{
    public function postLists($limit = Post::POST_PAGINATE)
    {
        $posts = Post::query()
            ->with('cms_category:id,name,slug', 'user:id,name')
            ->when(request('category'), function ($query) {
                return $query->whereHas('cms_category', function ($query) {
                    $query->where('slug', request('category'));
                });
            })
            ->when(request('tag'), function ($query) {
                return $query->whereHas('cms_tags', function ($query) {
                    $query->where('slug', request('tag'));
                });
            })
            ->isPublished()
            ->withCount('cms_category')
            ->latest()->paginate($limit)->withQueryString();
        
        return $posts;
    }
}
