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

	Route::resource('arls','arlController');
	Route::get('arls/{id}/destroy',[
		'uses' => 'arlController@destroy',
		'as' => 'arls.destroy'
	]);	
	Route::post('arls/crearAjax',[
		'uses' => 'arlController@crearAjax',
		'as' => 'arls.crearAjax'
	]);
	Route::get('arls/{id}/eliminarAjax',[
		'uses' => 'arlController@eliminarAjax',
		'as' => 'arls.eliminarAjax'
	]);
	Route::post('arls/validarDuplicado',[
		'uses' => 'arlController@validarDuplicado',
		'as' => 'arls.validarDuplicado'
	]);

	Route::resource('epss','epsController');
	Route::get('epss/{id}/destroy',[
		'uses' => 'epsController@destroy',
		'as' => 'epss.destroy'
	]);	
	Route::post('epss/crearAjax',[
		'uses' => 'epsController@crearAjax',
		'as' => 'epss.crearAjax'
	]);
	Route::get('epss/{id}/eliminarAjax',[
		'uses' => 'epsController@eliminarAjax',
		'as' => 'epss.eliminarAjax'
	]);
	Route::post('epss/validarDuplicado',[
		'uses' => 'epsController@validarDuplicado',
		'as' => 'epss.validarDuplicado'
	]);

});
