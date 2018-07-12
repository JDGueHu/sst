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

	Route::resource('fondos_pensiones','fondoPensionesController');

	Route::resource('tipos_identificacion','tiposIdentificacionController');

	Route::resource('generos','generoController');

	Route::resource('grupos_sanguineos','grupoSanguineoController');

	Route::resource('areas','areaController');

	Route::resource('niveles_riesgo','nivelesRiesgoController');

	Route::resource('cargos','nivelesRiesgoController');

	Route::resource('parametros','parametrosController');

	Route::resource('centros_trabajo','centrosTrabajoController');
	Route::post('centros_trabajo/crearAjax',[
		'uses' => 'centrosTrabajoController@crearAjax',
		'as' => 'centros_trabajo.crearAjax'
	]);
	Route::get('centros_trabajo/{modulo}/{id}/eliminarAjax',[
		'uses' => 'centrosTrabajoController@eliminarAjax',
		'as' => 'centros_trabajo.eliminarAjax'
	]);
	Route::post('centros_trabajo/validarDuplicado',[
		'uses' => 'centrosTrabajoController@validarDuplicado',
		'as' => 'centros_trabajo.validarDuplicado'
	]);
	Route::get('centros_trabajo/{modulo}/{id}/consultarAjax',[
		'uses' => 'centrosTrabajoController@consultarAjax',
		'as' => 'centros_trabajo.consultarAjax'
	]);
	Route::post('centros_trabajo/editarAjax',[
		'uses' => 'centrosTrabajoController@editarAjax',
		'as' => 'centros_trabajo.editarAjax'
	]);

});
