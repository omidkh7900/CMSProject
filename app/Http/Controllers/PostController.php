<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Services\UserRepository;
use const http\Client\Curl\AUTH_ANY;

class PostController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->authorizeResource(Post::class);
        $this->repository = $repository;
    }

    public function index(PostRequest $request)
    {
        if ($request->{Post::STATUS} == Post::STATUS_DELETED)
            $posts = Auth::user()->posts()->onlyTrashed();
        elseif ($request->{Post::STATUS} == Post::STATUS_UNPUBLISHED)
            $posts = Auth::user()->posts()->where('published', 0);
        else
            $posts = Auth::user()->posts()->where(Post::STATUS, 1);
        return view('post.index')
            ->with('posts', $posts->get())
            ->with(Post::STATUS, $request->{Post::STATUS});
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
        return view('post.show')
            ->with('post', $post)
            ->with('posts_user', Auth::id() == $post->user->id);
    }

    public function edit(Post $post)
    {
        return view('post.edit')->with('post', $post);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return redirect()->route('post.show', ['post' => $post->id]);
    }

    public function destroy(Post $post)
    {
        $this->repository->delete(false, $post);
        return redirect()->route('post.index', [Post::STATUS => Post::STATUS_PUBLISHED]);
    }

    public function restore($post)
    {
        Post::onlyTrashed()->find($post)->restore();
        return redirect()->route('post.index', [Post::STATUS => Post::STATUS_PUBLISHED]);
    }

    public function forceDelete($post)
    {
        $this->authorize('forceDelete',[Post::class,$post]);
        $post = Post::onlyTrashed()->find($post);
        $this->repository->delete(true, $post);
        return redirect()->route('post.index')->with(Post::STATUS, Post::STATUS_DELETED);
    }
}
