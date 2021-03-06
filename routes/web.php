<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

\Illuminate\Support\Facades\Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('UserManagement', UserManagement::class)
    ->parameter('UserManagement', 'user')
    ->except(['create', 'store'])
    ->middleware(['role:super-admin']);

Route::resource('PostManagement', PostManagementController::class)
    ->parameter('PostManagement', 'post')
    ->except(['create', 'store'])
    ->middleware(['role:super-admin']);
Route::post('PostManagement/{post}/restore', 'PostManagementController@restore')
    ->name('PostManagement.restore')
    ->middleware(['role:super-admin']);

Route::resource('category','CategoryController')
    ->parameter('category', 'category:slug')
    ->except(['index', 'show'])
    ->middleware(['role:super-admin']);
Route::resource('category','CategoryController')
    ->parameter('category', 'category:slug')
    ->only(['index', 'show']);

Route::resource('tag','TagController')
    ->parameter('tag', 'tag:slug')
    ->except(['index', 'show'])
    ->middleware(['role:super-admin']);
Route::resource('tag', 'TagController')
    ->parameter('tag', 'tag:slug')
    ->only(['index', 'show']);
