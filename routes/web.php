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

Route::group(['middleware' => 'auth'],function(){

	Route::resource('listas_desplegables','listasDesplegablesController');
	Route::post('listas_desplegables/crearAjax',[
		'uses' => 'listasDesplegablesController@crearAjax',
		'as' => 'listas_desplegables.crearAjax'
	]);
	Route::get('listas_desplegables/{modulo}/{id}/eliminarAjax',[
		'uses' => 'listasDesplegablesController@eliminarAjax',
		'as' => 'listas_desplegables.eliminarAjax'
	]);
	Route::post('listas_desplegables/validarDuplicado',[
		'uses' => 'listasDesplegablesController@validarDuplicado',
		'as' => 'listas_desplegables.validarDuplicado'
	]);
	Route::get('listas_desplegables/{modulo}/{id}/consultarAjax',[
		'uses' => 'listasDesplegablesController@consultarAjax',
		'as' => 'listas_desplegables.consultarAjax'
	]);
	Route::post('listas_desplegables/editarAjax',[
		'uses' => 'listasDesplegablesController@editarAjax',
		'as' => 'listas_desplegables.editarAjax'
	]);

	Route::resource('arl','arlController');

	Route::resource('eps','epsController');

	Route::resource('fondos_cesantias','fondosCesantiasController');

	Route::resource('fondos_pensiones','fondosPensionesController');

	Route::resource('tipos_identificacion','tiposIdentificacionController');

	Route::resource('generos','generosController');

	Route::resource('grupos_sanguineos','grupoSanguineoController');

	Route::resource('areas','areaController');

	Route::resource('niveles_riesgo','nivelesRiesgoController');

	Route::resource('estados_civiles','estadosCivilesController');

	Route::resource('parametros','parametrosController');
	Route::post('parametros/crearAjax',[
		'uses' => 'parametrosController@crearAjax',
		'as' => 'parametros.crearAjax'
	]);
	Route::get('parametros/{modulo}/{id}/eliminarAjax',[
		'uses' => 'parametrosController@eliminarAjax',
		'as' => 'parametros.eliminarAjax'
	]);
	Route::post('parametros/validarDuplicado',[
		'uses' => 'parametrosController@validarDuplicado',
		'as' => 'parametros.validarDuplicado'
	]);
	Route::get('parametros/{modulo}/{id}/consultarAjax',[
		'uses' => 'parametrosController@consultarAjax',
		'as' => 'parametros.consultarAjax'
	]);
	Route::post('parametros/editarAjax',[
		'uses' => 'parametrosController@editarAjax',
		'as' => 'parametros.editarAjax'
	]);

	Route::resource('centros_trabajo','centrosTrabajoController');
	Route::get('centros_trabajo/{centro_trabajo_id}/consultarAjax',[
		'uses' => 'centrosTrabajoController@consultarAjax',
		'as' => 'centros_trabajo.consultarAjax'
	]);

	Route::resource('cargos','cargosController');
	Route::get('cargos/{cargo_id}/consultarAjax',[
		'uses' => 'cargosController@consultarAjax',
		'as' => 'cargos.consultarAjax'
	]);


	Route::resource('empleados','empleadosController');


});
