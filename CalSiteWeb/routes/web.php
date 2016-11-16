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
    return view('auth/login');
});

/*
Route::get('/test', function () {
    return 'pageTest';
});

Route::get('/test/{param?}', function ($param = 'cyril') {
    return view('customView')->with('param', $param);
});*/

Route::get('/test/{param?}', 'MyController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

