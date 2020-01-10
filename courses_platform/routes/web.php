<?php
use App\Mail\MailtrapSending;
use Illuminate\Support\Facades\Mail;

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

// Route::get('/send-mail', function () {

//     Mail::to('amr.saami@gmail.com')->send(new MailtrapSending()); 

//     return 'A message has been sent to Mailtrap!';

// });


Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/verify/{token}', 'HomeController@verify')->name('verify');

// Route::group(['middleware' => ['auth']], function() {


//     Route::resource('roles','RoleController');
//     Route::resource('users','UserController');
//     Route::resource('courses','CourseController');
// });