<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index')->with('categories',Category::all());
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $category = Category::create(['Title' => $request->Title]);
        if (isset($request->image)) {
            $path = $request->file('image')->store('public');
            Image::create([
                'Title' => $request->Title,
                'Path' => 'app/' . $path,
                'imageable_type' => Category::class,
                'imageable_id' => $category->id
            ]);
        }
        return redirect()->route('category.index');
    }

    public function show(Category $category)
    {
        return view('category.show')->with('posts',$category->posts);
    }

    public function edit(Category $category)
    {
        return view('category.edit')->with('category', $category);
    }

    public function update(Request $request, Category $category)
    {
        $category->update([
            'Title' => $request->Title
        ]);
        if (isset($request->image)) {
            $path = $request->file('image')->store('public');
            Image::create([
                'Title' => $request->Title,
                'Path' => 'app/' . $path,
                'imageable_type' => Category::class,
                'imageable_id' => $category->id
            ]);
        }
        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        if (isset($category->image))
            Storage::delete(explode('app/', $category->image->Path)[1]);
        $category->delete();
        return redirect()->route('category.index');
    }
}
