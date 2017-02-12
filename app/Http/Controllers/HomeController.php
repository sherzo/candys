<?php

namespace App\Http\Controllers;

use App\Fondo;
use App\Saldo;
use App\Recibo;
use App\Gasto;
use App\Propietario;
use App\Gasto_extra;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saldo = Saldo::find(1);
        $fondo = Fondo::find(1);

        $propietarios = Propietario::all();
        $propietarios->each(function($propietarios){
          $propietarios->recibos;
        });

        $gastos = Gasto::all();
        $gastos->each(function($gastos){
          $gastos->recibos;
        });

        $gastos_extra = Gasto_extra::all();
        $gastos_extra->each(function($gastos_extra){
          $gastos_extra->recibos;
        });

        $mora = 0;
        $morosos = 0;
        $pagar = 0;
        foreach ($propietarios as $key => $propietario) {
          $mora = 0;
          foreach ($propietario->recibos as $key => $recibo) {
            if($recibo->pivot->estatus){
              $mora++;
            }
          }
          if($mora >= 2){
            $morosos++;
          }
        }

        foreach ($gastos as $gasto) {
          foreach ($gasto->recibos as $recibo) {
            if($recibo->pivot->estatus){
              $pagar = $pagar + $recibo->pivot->importe;
            }
          }
        }

        foreach ($gastos_extra as $gasto) {
          foreach ($gasto->recibos as $recibo) {
            if ($recibo->pivot->estatus) {
              $pagar = $pagar + $recibo->pivot->importe;
            }
          }
        }

        return view('home', compact('fondo', 'saldo', 'morosos', 'pagar'));
    }
}
