<?php

use Illuminate\Support\Facades\Route;


Route::get('/','PostController@index')->name('index');
Route::post('/','PostController@store')->name('store');
Route::get('/create','PostController@create')->name('create');
Route::get('/{post}','PostController@show')->name('show');
Route::put('/{post}','PostController@update')->name('update');
Route::delete('/{post}','PostController@delete')->name('delete');
Route::get('/{post}/edit','PostController@edit')->name('edit');
