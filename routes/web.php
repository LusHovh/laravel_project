<?php

Route::get('create', 'PostsController@create');
Route::get('/', 'PostsController@index');
Route::get('posts', 'PostsController@index');
Route::get('posts/{id}', 'PostsController@myPosts');
Route::get('posts/{id}/edit', 'PostsController@edit');
Route::get('posts/{id}/showPost', 'PostsController@showPost');

Route::post('add', 'PostController@uploadFiles');
Route::post('posts', 'PostsController@store');

Route::put('posts/{id}', 'PostsController@update');

Route::delete('posts/{id}', 'PostsController@destroy');

Auth::routes();

?>