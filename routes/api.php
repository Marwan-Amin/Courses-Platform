<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register', 'StudentCardenalityController@register');
Route::post('login', 'StudentCardenalityController@login');
Route::group([
    'middleware' => 'api',
    'prefix'=>'auth'
],function($router){
   
    Route::get('api/{token}', 'StudentController@verify')->name('api.mail');
        Route::get('user', 'StudentController@getAuthenticatedUser');
        Route::get('logout', 'StudentCardenalityController@logout');
        Route::put('user/{id}/edit', 'StudentController@edit');
        Route::get('closed', 'DataController@closed');
        Route::post('courses/{id}/enroll', 'StudentController@enroll');
        Route::post('courses/{id}/comment', 'StudentController@comment');
        Route::get('user/courses', 'StudentController@listCourses');

    });

