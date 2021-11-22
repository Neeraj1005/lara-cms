<?php

namespace Neeraj1005\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Neeraj1005\Cms\Models\CmsCategory;

class CmsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CmsCategory::latest()->paginate(config('cms.paginated_data'))->withQueryString();

        return view('cms::categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms::categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:60', 'unique:cms_categories,name'],
        ]);

        try {
            $data = CmsCategory::create($validatedData);
            return redirect(route('posts.categories.index'))->with('status', 'category ' . $data->name . ' created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CmsCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function show(CmsCategory $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CmsCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(CmsCategory $category)
    {
        return view('cms::categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CmsCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CmsCategory $category)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:60', Rule::unique('cms_categories')->ignore($category->id)],
        ]);

        try {
            $category->update($validatedData);

            return redirect(route('posts.categories.index'))->with('status', 'category updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CmsCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmsCategory $category)
    {
        $category->delete();

        return redirect(route('posts.categories.index'))->with('status', 'category deleted successfully');
    }
}
