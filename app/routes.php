<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@getIndex');
Route::get('logout', 'AuthController@getLogout');

Route::post('auth/signup', 'AuthController@postSignup');
Route::post('auth/login', 'AuthController@postLogin');


Route::post('create/post', 'PostController@postCreate');

Route::get('validPost/{id}', 'PostController@getValidate')->where('id', '[0-9]+');
Route::get('declinePost/{id}', 'PostController@getDecline')->where('id', '[0-9]+');

