<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('homepage');
});

Route::get('/home', function () {
    return view('homepage');
});

Route::get('/backend', function () {
    return view('layouts.backend');
});

Auth::routes();

Route::get('/category/{slug}', 'PostsController@listByCategory');
Route::get('/admin', 'Admin\HomeController@index');
Route::get('/Api/getListComment/{id}', 'ApiController@getListComment');
Route::post('/search/postlist', 'ApiController@searchPost');
Route::get('/{slug}', 'ApiController@getPostDetail');
Route::post('/post/addComment', 'ApiController@addComment');
Route::post('/post/deleteComment', 'ApiController@deleteComment');
Route::post('/post/countComment', 'ApiController@countComment');
Route::get('/pages/contact', 'HomePageController@showContact');
Route::get('/pages/about', 'HomePageController@showAbout');
Route::post('subscribe', 'HomePageController@addEmail');
Route::get('/test', function() {
    return view("test");
});

Route::get('/Api/getListPost', 'ApiController@getListPost');
Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'admin'], function() {

    Route::get('/home', 'Admin\HomeController@index');
    Route::get('/category', 'Admin\CategoriesController@index');

    Route::get('/category/{id}/edit', 'Admin\CategoriesController@edit');
    
    Route::put('/category/{id}', 'Admin\CategoriesController@update');
    
    Route::get('/category/create', 'Admin\CategoriesController@create');
    
    Route::post('/category', 'Admin\CategoriesController@store');
    
    Route::delete('/category/{id}', 'Admin\CategoriesController@destroy');

    Route::get('/post', 'Admin\PostsController@index'); 

    Route::get('/post/create', 'Admin\PostsController@create');

    Route::post('/post', 'Admin\PostsController@store');

    Route::get('/post/{id}/edit', 'Admin\PostsController@edit');

    Route::put('/post/{id}', 'Admin\PostsController@update');

    Route::delete('/post/{id}', 'Admin\PostsController@destroy');

    Route::get('/user', 'Admin\UsersController@index'); 

    Route::get('/user/create', 'Admin\UsersController@create');

    Route::post('/user', 'Admin\UsersController@store');

    Route::get('/user/{id}/edit', 'Admin\UsersController@edit');

    Route::put('/user/{id}', 'Admin\UsersController@update');

    Route::delete('/user/{id}', 'Admin\UsersController@destroy');

    Route::get('/comment', 'Admin\CommentController@index'); 

    Route::delete('/comment/{id}', 'Admin\CommentController@destroy');
    });
});

Route::prefix('user')->group(function () {
    Route::group(['middleware' => 'user'], function() {
    Route::get('/info/{id}/edit', 'User\InfoController@edit');
    Route::put('/info/{id}', 'User\InfoController@update');
    Route::get('/password/{id}/edit', 'User\InfoController@getPassword');
    Route::put('/password/{id}', 'User\InfoController@updatePassword');

    Route::get('/post', 'User\PostsController@index'); 

    Route::get('/post/create', 'User\PostsController@create');

    Route::post('/post', 'User\PostsController@store');

    Route::get('/post/{id}/edit', 'User\PostsController@edit');

    Route::put('/post/{id}', 'User\PostsController@update');

    Route::delete('/post/{id}', 'User\PostsController@destroy');
});
});