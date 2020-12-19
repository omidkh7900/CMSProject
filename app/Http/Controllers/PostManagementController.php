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
            ->with('posts', \request()->get('withTrashed') ?
                $this->repository->whereStatus(Post::STATUS_DELETED):
                $this->repository->whereStatus())
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

    public function destroy($post)
    {
        $post = $this->repository->whereStatus()->find($post);
//        !\request()->get('withTrashed') ?: Storage::delete(explode('app/', $post->image->Path)[1]);
//        \request()->get('withTrashed') ? $post->forceDelete() : $post->delete();
        $this->repository->delete(\request('withTrashed'),$post);
        return redirect()->route('PostManagement.index');
    }
}
