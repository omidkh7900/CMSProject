<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\tag;
use Illuminate\Http\Request;
use Services\UserRepository;

class HomeController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }

    public function index()
    {
        return view('home')
            ->with('posts', $this->repository->whereStatus(Post::STATUS_PUBLISHED))
            ->with('tags',tag::all())
            ->with('categories',Category::all());
    }
}
