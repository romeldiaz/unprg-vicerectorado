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


Route::get('perfil/imagen', 'PerfilController@getImagen');
Route::post('perfil/imagen', 'PerfilController@postImagen');
Route::get('perfil/password', 'PerfilController@getPassword');
Route::post('perfil/password', 'PerfilController@postPassword');
Route::get('perfil/edit', 'PerfilController@edit');
Route::resource('perfil', 'PerfilController');

Route::resource('notificaciones', 'NotificacionController');

Route::get('metas/{meta_id}/requisitos/create', 'RequisitoController@create')->name('requisito.create');
Route::get('metas/{meta_id}/requisitos/{requisito_id}/edit', 'RequisitoController@edit')->name('requisito.edit');
Route::resource('requisitos', 'RequisitoController');

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




// Route::get('metas/asignaciones', 'ActividadController@asignaciones')->name('metas.all');
// Route::get('actividades/creaciones', 'ActividadController@creaciones')->name('metas.my');
Route::resource('metas', 		'MetaController');
// Route::get('actividades/{actividad}/metas/create', 		'MetaController@create')->name('metas.create');
// Route::get('actividades/{actividad}/metas/edit/{meta}', 'MetaController@edit')	->name('metas.edit');
