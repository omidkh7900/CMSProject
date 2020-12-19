<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Services\UserRepository;

class PostManagementController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('PostManagement.index')
            ->with('posts', $this->repository
                ->whereStatus(\request('withTrashed')
                    ? Post::STATUS_DELETED
                    : null))
            ->with('withTrashed', \request()->get('withTrashed'));
    }

    public function show(Post $post)
    {
        return view('PostManagement.show')
            ->with('post', $post)->with('withTrashed', \request()->get('withTrashed'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return redirect()->route('PostManagement.show', ['post' => $post->id]);
    }

    public function restore($post)
    {
        Post::onlyTrashed()->find($post)->restore();
        return redirect()->route('PostManagement.index')->with('withTrashed', 1);
    }

    public function destroy($post)
    {
        $post = $this->repository->whereStatus(\request('withTrashed') ? Post::STATUS_DELETED : null)
            ->find($post);
        $this->repository->delete(\request('withTrashed'), $post);
        return redirect()->route('PostManagement.index');
    }
}
