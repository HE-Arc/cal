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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/editProfil', 'editProfilController@index');
Route::post('/editProfil', 'editProfilController@edit');

Route::post('calendar/members', 'AgendaController@addMember');
Route::get('calendar/members', 'AgendaController@indexMember');
Route::resource('/calendar', 'AgendaController');

Route::resource('/calendar/{calendarId}/tasks', 'TaskController', ['except' => ['index', 'show']]);
