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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('oficinas', 'OficinaController');

Route::post('users/post_js', 'UserController@post_js');
Route::resource('users', 'UserController');

Route::post('actividades/post_js', 'ActividadController@post_js');
Route::get('misActividades', 'ActividadController@misActividades');
Route::get('actividades/all', 'ActividadController@showAll');
Route::get('actividades/my', 'ActividadController@showMy');
Route::resource('actividades', 'ActividadController');

Route::resource('responsables', 'ResponsableController');

Route::get('javascript', 'JavascriptController@index');
Route::post('javascript', 'JavascriptController@funciones');
