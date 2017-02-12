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

  Route::get('propietarios/{propietario}/{recibo}/pagar', [
      'uses' => 'PropietarioController@payment',
      'as' => 'admin.propietarios.payment'
    ]);
  Route::get('propietarios/morosos', [
  	'uses' => 'PropietarioController@morosos',
  	'as' => 'admin.propietarios.morosos'
  	]);
	Route::resource('propietarios', 'PropietarioController');
	Route::get('propietarios/{id}/destroy', [
		'uses' => 'PropietarioController@destroy',
		'as' => 'admin.propietarios.destroy'
		]);
  Route::get('pdf-morosos',  ['as' => 'admin.pdf-morosos', function(){
    $propietarios = App\Propietario::all();
    $propietarios->each(function($propietarios){
      $propietarios->recibos;
      });

    $date = Carbon\Carbon::now();
    $pdf = PDF::loadView('admin.propietarios.pdf.morosos', ['propietarios' => $propietarios, 'date' => $date]);
    return $pdf->download('Listado de morosos '.$date->format('d-m-Y').'.pdf');

  }]);
  Route::get('gastos/{gasto}/{recibo}/{extra}/pagar', [
  		'uses' => 'GastoController@payment',
  		'as' => 'admin.gastos.payment'
  ]);

  Route::post('gastos/abonar', [
  		'uses' => 'GastoController@pay',
  		'as' => 'admin.gastos.pay'
  ]);

	Route::resource('gastos', 'GastoController');
  Route::get('gastos/actualizar/{id}', function($id){
    $gasto = App\Gasto::find($id);
    if($gasto->estatus){
      $gasto->estatus = false;
    }else{
      $gasto->estatus = true;
    }
    $gasto->save();

    return Response::json($gasto);
  });
	Route::resource('recibos', 'ReciboController');
  Route::get('recibos/cobrar/{id}', [
    'uses' => 'ReciboController@charge',
    'as' => 'admin.recibos.cobrar',
  ]);
  Route::post('recibos/pagar', [
    'uses' => 'ReciboController@payment',
    'as' => 'admin.recibos.payment',
  ]);

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

	Route::get('descargar-recibo/{id}',  ['as' => 'admin.descargar-recibo', function($id){
		$recibo = App\Recibo::find($id);
		return view('admin.recibos.descargar-recibo', compact('recibo'));
	}]);

	Route::get('recibos-piso/{id}/{primer}/{ultimo}',  ['as' => 'admin.recibos-piso', function($id, $primer, $ultimo){
		$pisos = array('1' => 'PB',
					   '5' => '1',
					   '9' => '2',
					   '13' => '3',
					   '17' => '4',
					   '21' => '5',
					   '25' => '6',
					   '29' => '7',
					   '33' => '8',
					   '37' => '9',
					   '41' => '10');
		foreach ($pisos as $key => $value) {
			if($key == $primer){
				$piso = $value;
			}
		}

		$propietarios = array();
		$contador = 1;
		for ($i=$primer; $i <=$ultimo; $i++) {
			$propietarios[$contador] = App\Propietario::find($i);
			$contador++;
		}

		foreach ($propietarios as $key => $propietario) {

				$propietario->each(function($propietario){
				$propietario->apartamentos;
				$propietario->recibos;
			});
		}


		$recibo = App\Recibo::find($id);
		$gastos = $recibo->gastos()->get();
		$gastos_extra = $recibo->gastos_extra()->get();
		$fondo = App\Fondo::find(1);


		// return view('admin.recibos.pdf.recibos-piso', compact('recibo', 'propietarios', 'gastos', 'gastos_extra', 'fondo'));

		$pdf = PDF::loadView('admin.recibos.pdf.recibos-piso', ['recibo' => $recibo, 'propietarios' => $propietarios, 'gastos' => $gastos, 'gastos_extra' => $gastos_extra, 'fondo' => $fondo]);

		return $pdf->download('recibos_piso_'.$piso.'_'.$recibo->mes.'_'.$recibo->anio.'.pdf');

	}]);


	Route::get('prueba/{prueba}', ['as' => 'admin.prueba', function($prueba){

		$recibo = App\Recibo::find($prueba);
    $propietarios = $recibo->propietarios()->get();
    $gastos = $recibo->gastos()->get();
		$gastos_extra = $recibo->gastos_extra()->get();
		$fondo = App\Fondo::find(1);

		return view('admin.recibos.pdf.recibos', compact('recibo', 'propietarios', 'gastos', 'gastos_extra', 'fondo'));
	}]);

  Route::get('consultas', [
    'uses' => 'ConsultasController@index',
    'as' => 'admin.consultas',
  ]);

  Route::get('consultas/mesual', [
    'uses' => 'ConsultasController@mensual',
    'as' => 'admin.consultas.mensual',
  ]);

  Route::post('consultas/nuevo', [
    'uses' => 'ConsultasController@store',
    'as' => 'admin.consultas.new',
  ]);

  Route::post('consultas/disponer', [
    'uses' => 'ConsultasController@provide',
    'as' => 'admin.consultas.disponer',
  ]);

  Route::post('consultas/prestaciones', [
    'uses' => 'ConsultasController@prestaciones',
    'as' => 'admin.consultas.prestaciones',
  ]);

  Route::get('pdf-movimiento/{mes}/{anio}',  [
    'uses' => 'ConsultasController@download',
    'as' => 'admin.pdf-movimiento',
  ]);

});
