<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

\Illuminate\Support\Facades\Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('UserManagement', UserManagement::class)
    ->parameter('UserManagement','user')
    ->except(['create', 'store'])
    ->middleware(['role:super-admin']);

Route::resource('PostManagement', PostManagementController::class)
    ->except(['create', 'store'])
    ->middleware(['role:super-admin']);
