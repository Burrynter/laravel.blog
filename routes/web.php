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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');

Route::resource('posts', 'PostsController');
Route::get('/post', 'PostsController@create');
Route::get('/{category}/{slug}', 'PostsController@show')->name('post');
Route::get('/{category}/{slug}/edit', 'PostsController@edit');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::resource('/categories', 'CategoriesController');
Route::get('/{category}', 'CategoriesController@show')->name('category');

Route::get('/tags', 'TagsController@index');
Route::get('/tags/{tag}', 'TagsController@show')->name('category');
