<?php

namespace App\Http\Controllers;

use App\Models\tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tag.index')->with('tags', tag::all());
    }

    public function create()
    {
        return view('tag.create');
    }

    public function store(Request $request)
    {
        tag::create(['Title' => $request->Title]);
        return redirect()->route('tag.index');
    }

    public function show(tag $tag)
    {
        return view('tag.show')->with('posts',$tag->posts);
    }

    public function edit(tag $tag)
    {
        return view('tag.edit')->with('tag', $tag);
    }

    public function update(Request $request, tag $tag)
    {
        $tag->update(['Title' => $request->Title]);
        return redirect()->route('tag.index');
    }

    public function destroy(tag $tag)
    {
        $tag->delete();
        return redirect()->route('tag.index');
    }
}
