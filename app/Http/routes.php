<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', 'Auth\AuthController@logout');

Route::group(['prefix' => '/', 'middleware' => 'guest', 'namespace' => 'Auth'], function() {
	/*
	|	RUTAS ANTES DE INICIAR SESIÓN NO MANDA ERROR 404
	|
	*/
	Route::post('login', 'AuthController@login');
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){ 

	Route::resource('/', 'HomeController@index');
	Route::resource('propiertarios', 'PropietaryController');

	});
