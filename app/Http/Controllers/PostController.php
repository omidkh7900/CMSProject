<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Services\UserRepository;

class PostController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(PostRequest $request)
    {
        return response()->json($this->repository->whereStatus($request->validated()[Post::STATUS]));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(CreatePostRequest $request)
    {
        Post::create($request->validated());
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show')->with('post', $post);
    }

    public function edit(Post $post)
    {
        return view('post.edit')->with('post', $post);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return redirect()->route('post.edit')->with('post', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
