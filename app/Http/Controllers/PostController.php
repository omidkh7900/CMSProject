<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\post;

class PostController extends Controller
{
    public function index()
    {
        $posts = post::all();
        return view('post.index')->with('posts', $posts);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(CreatePostRequest $request)
    {
        post::create($request->validated());
        return redirect()->route('post.index');
    }

    public function show(post $post)
    {
        return view('post.show')->with('post', $post);
    }

    public function edit(post $post)
    {
        return view('post.edit')->with('post', $post);
    }

    public function update(UpdatePostRequest $request, post $post)
    {
        $post->update($request->validated());
        return redirect()->route('post.edit')->with('post', $post);
    }

    public function destroy(post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
