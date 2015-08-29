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

Route::when('*', 'csrf', array('post', 'put', 'patch', 'delete'));

Route::get('/pkm/add', 'PkmController@create');

Route::post('/pkm/add','PkmController@store');

Route::get('/pkm/delete/{id}', 'PkmController@destroy');

Route::get('/auth/login', 'UserController@login');

Route::get('/pkm/edit/{id}','PkmController@edit');

Route::post('/pkm/edit/{id}','PkmController@update');

Route::get('/auth/logout','UserController@logout');

Route::get('/pkm/showall', 'PkmController@showall');

Route::get('/response','ResponseController@res');

Route::get('/auth/newUser','UserController@create');

Route::post('/auth/newUser','UserController@store');

