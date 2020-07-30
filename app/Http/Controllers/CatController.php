<?php

namespace App\Http\Controllers;

use App\Cat;
use Illuminate\Http\Request;
use App\Tag;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Cat;
        $category->title = $request->cat_title;
        $category->parent_id = $request->parent_id;
        $category->save();
        return redirect()->back();
    }

    public function tagStore(Request $request)
    {
        $tag = new Tag;
        $tag->title = $request->tag_title;
        $tag->action = $request->tag_action;
        $tag->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function show(Cat $cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function edit(Cat $cat)
    {
        return view('admin.category.edit', compact('cat'));
    }

    public function tagEdit(Tag $tag)
    {
        return view('admin.category.tag-edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cat $cat)
    {
        $cat->title = $request->name;
        // $cat->parent_id = $request->parent_id;
        $cat->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cat $cat)
    {
        $cat->delete();
        return redirect()->back();
    }
}
