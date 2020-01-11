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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/admin/view_teacher','AdminController@index')->name('admin.view_teacher');
Route::get('/admin/create_user','AdminController@create_user')->name('admin.create_user');
Route::post('/admin/user','AdminController@store')->name('admin.store');
Route::get('/admin/index/{value}','AdminController@index');
//Route::get('/admin/edit','AdminController@index')->name('admin.edit');
//Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
//Route::patch('/posts/{post}', 'PostController@update')->name('posts.update');
//Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
//Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
