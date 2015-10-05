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
Route::post('/register', 'RegisterController@index');

//Route::get('/admin', 'AdminController@index');
//Route::get('/admin/confirm-payment/{id}', 'AdminController@index');

//Route::get('/seat/{token}', 'SeatController@index');
//Route::post('/seat/{token}', 'SeatController@index');
