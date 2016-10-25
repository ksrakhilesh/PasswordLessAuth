<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/login/magic' , 'Auth\MagicLoginController@login');
Route::post('login/magic' , 'Auth\MagicLoginController@sendToken')->name('postlogin');
Route::get('/login/magic/{token}' , 'Auth\MagicLoginController@validateToken');
