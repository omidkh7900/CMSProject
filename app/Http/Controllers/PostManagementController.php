<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostManagementController extends Controller
{
    public function index()
    {
        return view('PostManagement.index')
            ->with('posts', \request()->get('withTrashed') ?
                Post::onlyTrashed()->with(['categories', 'image', 'tags'])->paginate(20) :
                Post::with(['categories', 'image', 'tags'])->paginate(20))
            ->with('withTrashed', \request()->get('withTrashed'));
    }

    public function show(Post $post)
    {
        return view('PostManagement.show')->with('post', $post)->with('withTrashed', \request()->get('withTrashed'));
    }

    public function update(Request $request, Post $post)
    {
        $validateR = $request->validate([
            'Title' => 'string|max:255',
            'Content' => 'string',
            'Slug' => 'string',
            'published' => 'boolean',
            'user_id' => 'integer',
        ]);
        $post->update($validateR);
        return redirect()->route('PostManagement.show', ['PostManagement' => $post->id]);
    }

    public function destroy($post)
    {
        $post = Post::withTrashed()->find($post);
        !\request()->get('withTrashed') ?: Storage::delete(explode('app/', $post->image->Path)[1]);
        \request()->get('withTrashed') ? $post->forceDelete() : $post->delete();
        return redirect()->route('PostManagement.index');
    }
}
