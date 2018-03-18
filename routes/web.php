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
Route::get('/', 'PagesController@index')->name('home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');
Route::post('/contact', 'PagesController@postContact')->name('contact');

Route::get('/tags', 'TagsController@index');
Route::get('/tags/{tag}', 'TagsController@show');

Route::resource('comments', 'CommentsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

//Admin routes
Route::middleware('role:admin')->group(function () {
    Route::get('/manage', 'ManagementController@index');
    
    Route::get('/manage/categories', 'ManagementController@categories')->name('manage.categories');
    Route::get('/categories/{category}/edit', 'CategoriesController@edit')->name('edit.category');
    Route::get('/manage/categories/new', 'CategoriesController@create');
    
    Route::get('/manage/posts', 'ManagementController@posts');
    Route::get('/manage/comments', 'ManagementController@comments');
    
    Route::get('/manage/tags', 'ManagementController@tags');
    Route::delete('manage/tags/{tag}/delete', 'TagsController@destroy');
    
    Route::get('/manage/users', 'ManagementController@users');
    Route::match(['get', 'post'], '/manage/users/role/{user_id}', 'ManagementController@user_roleChange');
    Route::delete('/manage/users/kill/{user_id}', 'ManagementController@user_kill');
});

Route::resource('/posts', 'PostsController', 
                ['except' => ['create', 'show', 'edit']]);
Route::get('/post', 'PostsController@create');
Route::get('/{category}/{post}', 'PostsController@show')->name('post');
Route::get('/{category}/{post}/edit', 'PostsController@edit');

Route::resource('/categories', 'CategoriesController',
                ['except' => ['index', 'show', 'create', 'edit']]);
Route::get('/categories', 'CategoriesController@index')->name('categories');
Route::get('/{category}', 'CategoriesController@show')->name('category');


