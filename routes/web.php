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
	Route::get('listas_desplegables/{id}/destroy',[
		'uses' => 'listasDesplegablesController@destroy',
		'as' => 'listas_desplegables.destroy'
	]);
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


});
