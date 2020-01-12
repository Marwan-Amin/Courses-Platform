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

//courses routes
Route::get('courses', 'CourseController@index')->name('courses.index');
Route::post('courses', 'CourseController@store');
Route::get('courses/create', 'CourseController@create')->name('courses.create');
Route::get('/courses/{course}', 'CourseController@show')->name('courses.show');
Route::get('/courses/{course}/edit', 'CourseController@edit')->name('courses.edit');
Route::put('/courses/{course}', 'CourseController@update')->name('courses.update');
Route::delete('/courses/{course}', 'CourseController@destroy')->name('courses.destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
