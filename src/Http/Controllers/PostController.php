<?php

namespace Neeraj1005\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Neeraj1005\Cms\Models\Post;
use Neeraj1005\Cms\Models\CmsTag;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Neeraj1005\Cms\Models\CmsCategory;
use Neeraj1005\Cms\Http\Requests\PostFormRequest;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $type = $request->type;

        $posts = Post::query()
            ->when($type == Post::TYPE_DRAFT, function ($query) {
                return $query->isDraft();
            }, function ($query) {
                return $query->isPublished();
            })->latest()->paginate(config('cms.paginated_data'))->withQueryString();

        return view('cms::posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms::posts.create', [
            'categories' => CmsCategory::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::transaction(function () use ($validatedData, $request) {
                if ($request->hasFile('picture')) {
                    $file = $request->file('picture');

                    $path_url = $file->storePublicly('cms', 'public');

                    $validatedData['picture'] = $path_url;
                }

                $post = $this->postStore(request('postType'), $validatedData);

                if ($request->tags != '') {
                    $tags = explode(',', $request->tags);
                    foreach ($tags as $value) {
                        $tag = CmsTag::firstOrCreate(['name' => $value]);
                        $post->cms_tags()->attach($tag);
                    }
                }
            });

            return redirect()->route('posts.index', ['type' => request('postType')])->with('status', 'post created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::isPublished()->findOrFail($id);

        return view('cms::posts.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = CmsCategory::pluck('name', 'id');
        $post->load('cms_tags');
        return view('cms::posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        try {
            DB::transaction(function () use ($validatedData, $request, $id) {
                if ($request->hasFile('picture')) {
                    $file = $request->file('picture');
                    $path_url = $file->storePublicly('cms', 'public');
                    $validatedData['picture'] = $path_url;
                }

                $post = $this->postUpdate(request('postType'), $validatedData, $id);

                if ($request->tags != '') {
                    $tags = explode(',', $request->tags);
                    foreach ($tags as $value) {
                        $tag = CmsTag::updateOrCreate(['name' => $value]);
                        $tagIds[] = $tag->id;
                    }
                    $post->cms_tags()->sync($tagIds);
                }
            });
            return redirect()->route('posts.index', ['type' => request('postType')])->with('status', 'post updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect(route('posts.index'))->with('status', 'post deleted successfully');
    }

    protected function postStore(string $type = null, array $validatedData)
    {
        switch ($type) {
            case 'draft':
                $validatedData['published'] = false;
                $validatedData['isActive'] = false;
                break;

            default:
                $validatedData['published'] = true;
                break;
        }

        if ($validatedData['category']) {
            $validatedData['cms_category_id'] = $validatedData['category'];
        }

        $postData = Post::create($validatedData);

        return $postData;
    }

    protected function postUpdate(string $type = null, array $validatedData, $id)
    {
        switch ($type) {
            case 'draft':
                $validatedData['published'] = false;
                $validatedData['isActive'] = false;
                break;

            default:
                $validatedData['published'] = true;
                break;
        }

        if ($validatedData['category']) {
            $validatedData['cms_category_id'] = $validatedData['category'];
        }

        $postData = Post::findOrFail($id);

        $postData->update($validatedData);

        return $postData;
    }
}
