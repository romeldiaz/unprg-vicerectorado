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
	// return view('login');
	return redirect()->route('login');
});
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('oficinas', 'OficinaController');
Route::post('users/post_js', 'UserController@post_js');
Route::resource('users', 'UserController');

Route::post('actividades/post_js', 'ActividadController@post_js');
Route::get('actividades/asignaciones', 'ActividadController@asignaciones');
Route::get('actividades/creaciones', 'ActividadController@creaciones');
Route::get('actividades/monitoreos', 'ActividadController@monitoreos');
Route::resource('actividades', 	'ActividadController');
Route::resource('responsables', 'ResponsableController');
Route::resource('gastos', 		'GastoController');
Route::get('javascript', 'JavascriptController@index');
Route::post('javascript', 'JavascriptController@funciones');




Route::get('actividades/asignaciones', 'ActividadController@asignaciones')->name('metas.all');
Route::get('actividades/creaciones', 'ActividadController@creaciones')->name('metas.my');
Route::resource('metas', 		'MetaController');
// Route::get('actividades/{actividad}/metas/create', 		'MetaController@create')->name('metas.create');
// Route::get('actividades/{actividad}/metas/edit/{meta}', 'MetaController@edit')	->name('metas.edit');
