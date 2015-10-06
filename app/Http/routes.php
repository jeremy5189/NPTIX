<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', 'RegisterController@index');
Route::post('/register', 'RegisterController@store');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/login', 'AdminController@login_view');
Route::get('/admin/logout', 'AdminController@logout');
Route::post('/admin/login', 'AdminController@login');
Route::get('/admin/confirm/{id}', 'AdminController@confirm');
Route::get('/admin/cancel/{id}', 'AdminController@cancel');
Route::get('/admin/destroy/{id}', 'AdminController@destroy');

Route::get('/seat/{token}', 'SeatController@show');
Route::get('/seat/{token}/{seat}', 'SeatController@select');
