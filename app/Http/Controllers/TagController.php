<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tag.index')->with('tags',tag::all());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    public function show(tag $tag)
    {
        return view('tag.show')->with('posts',$tag->posts);
    }

    public function edit(tag $tag)
    {
        //
    }

    public function update(Request $request, tag $tag)
    {
        //
    }

    public function destroy(tag $tag)
    {
        //
    }
}
