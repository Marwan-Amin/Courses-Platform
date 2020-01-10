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
Route::post('login', 'StudentController@authenticate');
Route::get('api/{token}', 'StudentController@verify')->name('api.mail');

Route::get('open', 'DataController@open');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'StudentController@getAuthenticatedUser')->middleware('verified');
    Route::get('closed', 'DataController@closed')->middleware('verified');
});
