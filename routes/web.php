<?php

/*
Route::get('/', function () {
    return view('welcome');
});
*/

// 文章列表页
Route::get('/posts', '\App\Http\Controllers\PostController@index');
// 创建文章
Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
Route::post('/posts', '\App\Http\Controllers\PostController@store');
// 文章详情页
Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');
// 编辑文章
Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');
// 删除文章
Route::get('/posts/delete', '\App\Http\Controllers\PostController@delete');































