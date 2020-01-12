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
Route::post('register', 'StudentController@register');
Route::post('login', 'StudentController@login');
Route::group([
    'prefix'=>'auth'
],function($router){
   
    Route::get('api/{token}', 'StudentController@verify')->name('api.mail');
        Route::get('user', 'StudentController@getAuthenticatedUser');
        Route::get('logout', 'StudentController@logout');
        Route::put('user/{id}/edit', 'StudentController@edit');
        Route::get('closed', 'DataController@closed');
    });

