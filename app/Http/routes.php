<?php
session_start();
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/personas', '\Idrd\Usuarios\Controllers\PersonaController@index');
Route::get('/personas/service/obtener/{id}', '\Idrd\Usuarios\Controllers\PersonaController@obtener');
Route::get('/personas/service/buscar/{key}', '\Idrd\Usuarios\Controllers\PersonaController@buscar');
Route::get('/personas/service/ciudad/{id_pais}', '\Idrd\Usuarios\Controllers\LocalizacionController@buscarCiudades');
Route::post('/personas/service/procesar/', '\Idrd\Usuarios\Controllers\PersonaController@procesar');
Route::get('/actividad_usuario/{identificacion?}', function ($identificacion = null) { 
	return view('idrd.usuarios.persona_actividades', [
		'seccion' => 'Actividades',
		'identificacion' => $identificacion
	]); 
});
Route::get('/usuario_tipo', function () { return view('persona_tipoPersona'); });
Route::get('/asignarActividad', '\Idrd\Usuarios\Controllers\AsignarActividadController@asignarActividades');
Route::get('/actividadesModulo', '\Idrd\Usuarios\Controllers\AsignarActividadController@moduloActividades');
Route::get('/actividadesPersona/{id}', '\Idrd\Usuarios\Controllers\AsignarActividadController@personaActividades');
Route::any('PersonasActividadesProceso', '\Idrd\Usuarios\Controllers\AsignarActividadController@PersonasActividadesProceso');

Route::any('/', 'MainController@index');
Route::any('/logout', 'MainController@logout');

//rutas con filtro de autenticación
Route::group(['middleware' => ['web']], function () {
	Route::get('/welcome', 'MainController@welcome');
});