<?php



Route::get('login', 'AuthController@index')->name('login');
Route::post('login',   'AuthController@login');
Route::group(array('before'=>'auth'), function (){
  Route::get('/', 'DashboardController@index');
  Route::get('logout', 'AuthController@logout');
});


Route::resource('perfil', 'PerfilController');



Route::get('dashboard', 'DashboardController@index');
Route::get('dashboard/tareas', 'DashboardController@tareas');
//Route::get('dashboard/perfil', 'DashboardController@perfil');
Route::get('dashboard/misMetas', 'DashboardController@misMetas');

Route::resource('oficinas', 'OficinaController');

Route::resource('usuarios', 'UsuarioController');
Route::post('usuarios/checkOficina', 'UsuarioController@postCheckOficina');//de la vista create



Route::post('actividades/actividad_js', 'ActividadController@actividad_js');
Route::get('actividades/{actividad_id}/metas/create', 'MetaController@create');
Route::get('actividades/{actividad_id}/metas/{meta_id}/edit', 'MetaController@edit');
Route::delete('actividades/{actividad_id}/metas/{meta_id}/destroy', 'MetaController@destroy');
Route::resource('actividades', 'ActividadController');

Route::get('monitoreos/{op}', 'MonitoreoController@index');
Route::post('monitoreos/create', 'MonitoreoController@create');
Route::post('monitoreos/edit', 'MonitoreoController@edit');
Route::resource('monitoreos', 'MonitoreoController',
                ['except' => ['index', 'create', 'edit']]);

Route::resource('documentos', 'DocumentoController');

Route::post('metas/meta_js', 'MetaController@meta_js');
//Route::get('metas/actividad/id', 'MetaController@index');//condicionar metodo defaul index para que acepte un id de actividad
Route::resource('metas', 'MetaController');







/*Manejo de archivos*/
Route::post('file/uploadPhoto/{id}', 'FileController@uploadPhoto');
Route::get('file/downloadPhoto/{nombre}', 'FileController@downloadPhoto');


Route::get('gastos/create/{meta_id}', 'GastoController@create');
Route::get('gastos/edit/{meta_id}/{gastos_id}/', 'GastoController@edit');
Route::resource('gastos', 'GastoController');
