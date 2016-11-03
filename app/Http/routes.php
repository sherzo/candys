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
	Route::resource('propietarios', 'PropietarioController');
	Route::get('propietarios/{id}/destroy', [
		'uses' => 'PropietarioController@destroy',
		'as' => 'admin.propietarios.destroy'
		]);
	Route::resource('gastos', 'GastoController');
	Route::resource('recibos', 'ReciboController');
	

	Route::get('pdf/{id}',  ['as' => 'admin.pdf', function($id){

		$propietario = App\Propietario::find(1);
		$apartamentos = $propietario->apartamentos()->get();

		$recibo = App\Recibo::find($id);
		$gastos = $recibo->gastos()->get();
		$gastos_extra = $recibo->gastos_extra()->get();
		$fondo = App\Fondo::find(1);
		
		
		$pdf = PDF::loadView('admin.recibos.pdf.recibos', ['recibo' => $recibo, 'propietario' => $propietario, 'gastos' => $gastos, 'gastos_extra' => $gastos_extra, 'apartamentos' => $apartamentos, 'fondo' => $fondo]);
		return $pdf->download('recibo_'.$recibo->mes.'_'.$recibo->anio.'.pdf');
	
	}]);


	Route::get('prueba/{prueba}', ['as' => 'admin.prueba', function($prueba){

		$propietario = App\Propietario::find(1);
		$apartamentos = $propietario->apartamentos()->get();

		$recibo = App\Recibo::find($prueba);
		$gastos = $recibo->gastos()->get();
		$gastos_extra = $recibo->gastos_extra()->get();
		$fondo = App\Fondo::find(1);

		return view('admin.recibos.pdf.recibos', compact('recibo', 'propietario', 'gastos', 'gastos_extra', 'apartamentos', 'fondo'));
	}]);

});
