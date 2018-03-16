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

//Статические страницы
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');
Route::post('/contact', 'PagesController@postContact')->name('contact');

Route::get('/tags', 'TagsController@index');
Route::get('/tags/{tag}', 'TagsController@show');

Route::resource('comments', 'CommentsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::resource('posts', 'PostsController');
Route::get('/post', 'PostsController@create');
Route::get('/{category}/{slug}', 'PostsController@show')->name('post');
Route::get('/{category}/{slug}/edit', 'PostsController@edit');

Route::resource('categories', 'CategoriesController');
Route::get('/{category}', 'CategoriesController@show')->name('category');


