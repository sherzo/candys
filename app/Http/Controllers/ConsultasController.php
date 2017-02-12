<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recibo;
use App\Gasto;
use App\Gasto_extra;
use App\Prestacion;
use App\Saldo;
use App\Fondo;
use App\Movimiento;
use App\Propietario;
use App\Http\Requests;
use Carbon\Carbon;
use App\Movimiento_fondo;
use Laracasts\Flash\Flash;
use PDF;

class ConsultasController extends Controller
{
    public function index()
    {
      $gastos = Gasto::all();
      $gastos->each(function($gastos){
        $gastos->recibos;
      });

      $gastos_extra = Gasto_extra::all();
      $gastos_extra->each(function($gastos_extra){
        $gastos_extra->recibos;
      });

      $movimientos_fondo = Movimiento_fondo::orderBy('id', 'DESC')->get();

      $propietarios = Propietario::all();
      $propietarios->each(function($propietarios){
        $propietarios->recibos;
      });

      $hoy = Carbon::now();
      $mes = $hoy->format('m');
      $anio = $hoy->format('Y');

      $movimientos = Movimiento::orderBy('id', 'DESC')->get();
      $saldo = Saldo::find(1);
      $fondo = Fondo::find(1);
      $date = Carbon::now();

      $pagar = 0;
      $cobrar = 0;

      foreach ($gastos as $gasto) {
        foreach ($gasto->recibos as $recibo) {
          if($recibo->pivot->estatus){
            $pagar = $pagar + $recibo->pivot->importe;
          }
        }
      }

      if($gastos_extra != '[]')
      {
        foreach ($gastos_extra as $extra) {
          foreach ($extra->recibos as $recibo) {
            if($recibo->pivot->estatus){
              $pagar = $pagar + $recibo->pivot->importe;
            }
          }
        }
      }

      foreach ($propietarios as $key => $propietario) {
        foreach ($propietario->recibos as $key => $recibo) {
          if($recibo->pivot->estatus){
            if($recibo->pivot->mora)
            {
              $monto = $recibo->cuota + $recibo->cuota * 0.10;
              $cobrar = $cobrar + $monto;
            }else{
              $cobrar = $cobrar + $recibo->cuota;
            }
          }
        }
      }

      $prestaciones = Prestacion::first();

      return view('admin.consultas.index', compact('pagar', 'cobrar', 'mes', 'anio', 'gastos', 'gastos_extra', 'movimientos', 'saldo', 'fondo', 'propietarios', 'movimientos_fondo', 'prestaciones'));
    }

    /*
    *  CONSULTAS MENSUALES
    *
    */

    public function mensual(Request $request)
    {
      if($request->fecha){
        list($anio, $mes) = explode("-", $request->fecha);
      }

      $movimientos = Movimiento::where('created_at', 'LIKE', '%'.$request->fecha.'%')->get();


      $movimientos_fondo = Movimiento_fondo::where('created_at', 'LIKE', '%'.$request->fecha.'%')->get();

      $ingresos = 0;
      $egresos = 0;
      $ingresos_fondo = 0;
      $egresos_fondo = 0;

      foreach ($movimientos as $key => $movimiento)
      {
        if($movimiento->signo == '+'){
          $ingresos = $ingresos + $movimiento->monto;
        }else {
          $egresos = $egresos + $movimiento->monto;
        }
      }

      foreach ($movimientos_fondo as $key => $movimiento)
      {
        if($movimiento->signo == '+'){
          $ingresos_fondo = $ingresos_fondo + $movimiento->monto;
        }else {
          $egresos_fondo = $egresos_fondo + $movimiento->monto;
        }
      }

      return view('admin.consultas.mensual', compact('ingresos', 'egresos', 'movimientos', 'movimientos_fondo', 'ingresos_fondo', 'egresos_fondo', 'mes', 'anio'));
    }

    /*
    * NUEVO INGRESO Y EGRESO
    */

    public function store(Request $request)
    {
      $movimiento = new Movimiento($request->all());
      $saldo = Saldo::find(1);

      if($request->signo == '+')
      {
        $saldo->saldo = $saldo->saldo + $movimiento->monto;
      }else{

        if($movimiento->monto > $saldo->saldo)
        {
          Flash::error('<strong>¡Cuidado!</strong> El monto que desea descontar es mayor al saldo disponible');
          return redirect()->back();
        }
        $saldo->saldo = $saldo->saldo - $movimiento->monto;
      }

      $movimiento->saldo = $saldo->saldo;

      $movimiento->save();
      $saldo->save();

      Flash::success('<strong>¡Perfecto!</strong> se registro el movimiento');
      return redirect()->back();

    }

    /*
    * DISPONER FONDO DE RESERVA
    */

    public function provide(Request $request)
    {
      $fondo = Fondo::find(1);

      if ($fondo->real < $request->monto)
      {

        Flash::error('<strong>¡Cuidado!</strong> el monto es mayor al fondo de reserva disponible');
        return redirect()->back();

      }else
      {

        $fondo->real = $fondo->real - $request->monto;
        $fondo->save();
        $movimientos_fondo = new Movimiento_fondo($request->all());
        $movimientos_fondo->saldo_fondo = $fondo->real;
        $movimientos_fondo->save();

        Flash::success('<strong>¡Perfecto!</strong> se registro el movimiento del fondo');
        return redirect()->back();
      }

    }


    public function download($mes, $anio)
    {

      $movimientos = Movimiento::where('created_at', 'LIKE', '%'.$anio.'-'.$mes.'%')->get();

      $movimientos_fondo = Movimiento_fondo::where('created_at', 'LIKE', '%'.$anio.'-'.$mes.'%')->get();

      $ingresos = 0;
      $egresos = 0;
      $ingresos_fondo = 0;
      $egresos_fondo = 0;

      foreach ($movimientos as $key => $movimiento)
      {
        if($movimiento->signo == '+'){
          $ingresos = $ingresos + $movimiento->monto;
        }else {
          $egresos = $egresos + $movimiento->monto;
        }
      }

      foreach ($movimientos_fondo as $key => $movimiento)
      {
        if($movimiento->signo == '+'){
          $ingresos_fondo = $ingresos_fondo + $movimiento->monto;
        }else {
          $egresos_fondo = $egresos_fondo + $movimiento->monto;
        }
      }

      $pdf = PDF::loadView('admin.consultas.pdf.movimiento', ['movimientos' => $movimientos,
                                                              'mes' => $mes,
                                                              'anio' => $anio,
                                                              'ingresos' => $ingresos,
                                                              'egresos' => $egresos,
                                                              'ingresos_fondo' => $ingresos_fondo,
                                                              'egresos_fondo' => $egresos_fondo]);

  		return $pdf->download('movimientos '. $mes .'-'.$anio.'.pdf');
    }


    public function prestaciones(Request $request)
    {
      dd($request->all());
    }

}// Clase Controller
