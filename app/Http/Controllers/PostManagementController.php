<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostManagementController extends Controller
{
    public function index()
    {
        return view('PostManagement.index')
            ->with('posts', \request()->get('withTrashed') ?
                post::onlyTrashed()->with(['categories', 'image', 'tags'])->paginate(20) :
                post::with(['categories', 'image', 'tags'])->paginate(20))
            ->with('withTrashed', \request()->get('withTrashed'));
    }

    public function show(post $PostManagement)
    {
        return view('PostManagement.show')->with('post', $PostManagement)->with('withTrashed', \request()->get('withTrashed'));
    }

    public function update(Request $request, post $PostManagement)
    {
        $validateR = $request->validate([
            'Title' => 'required|string|max:255',
            'Content' => 'required|string',
            'Slug' => 'required|string',
            'published' => 'boolean',
            'user_id' => 'required|integer',
        ]);
        $PostManagement->update($validateR);
        return redirect()->route('PostManagement.show', ['PostManagement' => $PostManagement->id]);
    }

    public function destroy($PostManagement)
    {
        $PostManagement = post::withTrashed()->find($PostManagement);
        !\request()->get('withTrashed') ?: Storage::delete(explode('app/', $PostManagement->image->Path)[1]);
        \request()->get('withTrashed') ? $PostManagement->forceDelete() : $PostManagement->delete();
        return redirect()->route('PostManagement.index');
    }
}
