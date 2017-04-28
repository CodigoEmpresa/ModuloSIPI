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

	Route::get('getFichaTecnicaDatos/','FichaTecnicaController@GetFichaTecnicaDatos');
	Route::get('getFichaTecnicaDatosOne/{id}','FichaTecnicaController@GetFichaTecnicaDatosOne');

	Route::post('addFichaTecnica', 'FichaTecnicaController@registroFichaTecnica');
	Route::post('editFichaTecnica', 'FichaTecnicaController@modificarFichaTecnica');

	Route::get('fichaTecnica', 'FichaTecnicaController@indexRegistro');
	Route::get('fichaTecnica/{id}/editar', 'FichaTecnicaController@editar');
	Route::get('fichaTecnica/crear', 'FichaTecnicaController@crear');
	Route::post('fichaTecnica/procesar', 'FichaTecnicaController@procesar');

	Route::get('apu', 'ItemController@inicio');
	Route::get('item/unidades/{unidad?}', 'UnidadController@buscarUnidadesDeMedida');
	Route::post('item/crear', 'ItemController@crear');
	Route::get('item/obtener/{item?}', 'ItemController@obtenerItem');
	Route::get('item/buscar/{item?}', 'ItemController@buscarItem');
	Route::post('item/agregar_insumo', 'ItemController@agregarInsumo');
	Route::post('item/remover_insumo', 'ItemController@removerInsumo');

	Route::post('insumo/crear', 'InsumoController@crear');
	Route::get('insumo/obtener/{insumo?}', 'InsumoController@obtenerInsumo');
	Route::get('insumo/buscar/{insumo?}', 'InsumoController@buscarInsumo');

	Route::post('proveedor/crear', 'ProveedorController@crear');
	Route::post('cotizacion/crear', 'CotizacionController@crear');
	Route::get('cotizacion/obtener/{cotizacion?}', 'CotizacionController@obtener');
});
