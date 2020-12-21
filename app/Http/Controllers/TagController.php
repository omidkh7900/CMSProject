<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\tag;
use Illuminate\Http\Request;
use Services\interfaces\TagRepository;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        //ایا ماباید برای tag::all یه تابع داخل tagRepository درست کنیم؟
        return view('tag.index')->with('tags', tag::all());
    }

    public function create()
    {
        return view('tag.create');
    }

    public function store(CreateTagRequest $request)
    {
        $this->tagRepository->create($request->validated());
        return redirect()->route('tag.index');
    }

    public function show(tag $tag)
    {
        //ایا ماباید برای tag->posts یه تابع داخل tagRepository درست کنیم؟
        return view('tag.show')->with('posts', $tag->posts);
    }

    public function edit(tag $tag)
    {
        return view('tag.edit')->with('tag', $tag);
    }

    public function update(UpdateTagRequest $request, tag $tag)
    {
        $this->tagRepository->update($tag,$request->validated());
        return redirect()->route('tag.index');
    }

    public function destroy(tag $tag)
    {
        $this->tagRepository->delete($tag);
        return redirect()->route('tag.index');
    }
}
