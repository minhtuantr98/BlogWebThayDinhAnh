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
    return view('home');
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');
Route::get('/test', function() {
    return view("test");
});
Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'admin'], function() {
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
    });
});

Route::prefix('user')->group(function () {
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