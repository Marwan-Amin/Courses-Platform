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
Route::get('/admin/create','TeacherController@create')->name('admin.create');
Route::post('/admin/user','TeacherController@store')->name('admin.store');
Route::get('/admin/index/{value}','TeacherController@index')->name('admin.index');
Route::get('/admin/{id}','TeacherController@show')->name('admin.show');
Route::delete('/admin/{id}', 'TeacherController@destroy')->name('admin.destroy');
Route::patch('/admin/{id}', 'TeacherController@update')->name('admin.update');
Route::get('/admin/{id}/edit', 'TeacherController@edit')->name('admin.edit');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//make charts route
Route::get('/charts', 'UserController@charts');
