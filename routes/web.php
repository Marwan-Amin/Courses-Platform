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
    return view('users.index');
});

Route::get('/admin/view_teacher','AdminController@index')->name('admin.view_teacher');
Route::get('/admin/create_user','UserController@create_user')->name('admin.create_user');
Route::post('/admin/user','AdminController@store')->name('admin.store');
Route::get('/admin/index','AdminController@index')->name('admin.index');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('courses','ProductController');
});
