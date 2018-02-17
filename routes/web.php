<?php
Route::get('/', function () {
    return view('welcome');
});

Route::resource('oficinas', 'OficinaController');


Route::resource('usuarios', 'UsuarioController');
Route::post('usuarios/checkOficina', 'UsuarioController@postCheckOficina');//de la vista create

Route::post('actividades/cargarResponsables', 'ActividadController@cargarResponsables');
Route::post('actividades/buscarResponsable', 'ActividadController@buscarResponsable');
Route::post('actividades/responsableSelected', 'ActividadController@responsableSelected');
Route::resource('actividades', 'ActividadController');
