<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('contact', 'pagesController@getContact');
Route::get('about', 'pagesController@getAbout');
Route::get('create', 'PostsController@create');
Route::post('add', 'PostController@uploadFiles');
Auth::routes();
Route::get('/', 'PostsController@index');
Route::get('posts', 'PostsController@index');
Route::post('posts', 'PostsController@store');
Route::get('posts/{id}', 'PostsController@myPosts');
Route::get('posts/{id}/edit', 'PostsController@edit');
Route::get('/create', 'PostsController@create');
Route::put('posts/{id}', 'PostsController@update');
Route::delete('posts/{id}', 'PostsController@destroy');
Route::get('posts/{id}/showPost', 'PostsController@showPost');








