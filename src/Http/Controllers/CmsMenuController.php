<?php

namespace Neeraj1005\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Neeraj1005\Cms\Models\CmsMenu;

class CmsMenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = CmsMenu::latest()->paginate(CmsMenu::MENU_PAGINATE);

        return view('cms::menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms::menus.create');
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
            'name' => ['required', 'string', 'max:10'],
            'url' => ['required', 'url'],
        ]);

        try {
            if ($request->is_checked) {
                $validatedData['is_checked'] = true;
            }

            CmsMenu::create($validatedData);

            return redirect()->route('cms.menus.index')->with('message', 'menu added successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!. ' . $th->getMessage());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CmsMenu $menu)
    {
        return view('cms::menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CmsMenu $menu)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:10'],
            'url' => ['required', 'url'],
        ]);

        try {
            if ($request->is_checked) {
                $validatedData['is_checked'] = true;
            } else {
                $validatedData['is_checked'] = false;
            }

            $menu->update($validatedData);

            return redirect()->route('cms.menus.index')->with('message', 'menu updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!. ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmsMenu $menu)
    {
        try {
            $menu->delete();
            return redirect()->route('cms.menus.index')->with('status', 'menu deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!. ' . $th->getMessage());
        }

    }
}
