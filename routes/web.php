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

Route::get('/admin/create_user','AdminController@create_user')->name('admin.create_user');
Route::post('/admin/user','AdminController@store')->name('admin.store');
Route::get('/admin/index/{value}','AdminController@index')->name('admin.index');
Route::get('/admin/{id}','AdminController@show')->name('admin.show');
Route::delete('/admin/{id}', 'AdminController@destroy')->name('admin.destroy');
Route::patch('/admin/{id}', 'AdminController@update')->name('admin.update');
Route::get('/admin/{id}/edit', 'AdminController@edit')->name('admin.edit');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
