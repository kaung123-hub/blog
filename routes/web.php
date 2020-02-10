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
    return view('home');
});
// Route::resource('blog-posts','BlogPostController')->only(['index','show','create','store','edit','update']); // use funtion only in the parathesis

// Route::resource('blog-posts','BlogPostController')->except[('destroy')];//only destroy is not working 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('blog-posts','BlogPostController');
});

Route::get('/sendhtmlemail','MailController@html_email');

Route::resource('subscribers','SubscriberController')->only(['store']);

Route::get('/confirmation','SubscriberController@confirmation');

Route::post('/confirmationEmail', 'SubscriberController@confirmationEmail');

