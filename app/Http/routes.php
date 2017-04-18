<?php
session_start();
session_set_cookie_params(5000000000, "/");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
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
	Route::get('registroFT', 'FichaTecnicaController@indexRegistro');
	Route::post('addFichaTecnica', 'FichaTecnicaController@registroFichaTecnica');
	Route::post('editFichaTecnica', 'FichaTecnicaController@modificarFichaTecnica');

	Route::get('getFichaTecnicaDatos/','FichaTecnicaController@GetFichaTecnicaDatos');
	Route::get('getFichaTecnicaDatosOne/{id}','FichaTecnicaController@GetFichaTecnicaDatosOne');

	Route::get('fichaTecnica/{id}/detalles', 'FichaTecnicaController@detalles');
	Route::get('item/unidades/{unidad?}', 'UnidadController@buscarUnidadesDeMedida');

	Route::get('item', 'ItemController@inicio');
	Route::post('item/crear', 'ItemController@crear');
	Route::get('item/obtener/{item?}', 'ItemController@obtenerItem');
	Route::get('item/buscar/{item?}', 'ItemController@buscarItem');

	Route::post('insumo/crear', 'InsumoController@crear');
	Route::get('insumo/buscar/{insumo?}', 'InsumoController@buscarInsumo');
});
