<?php

namespace App\Http\Controllers;

use App\Fondo;
use App\Gasto;
use App\Gasto_extra;
use App\Propietario;
use App\Http\Requests;
use App\Recibo;
use App\Movimiento;
use App\Movimiento_fondo;
use App\Saldo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Barryvdh\DomPDF\PDF;

class ReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $recibos = Recibo::all();
        foreach ($recibos as $key => $recibo) {
          $d = Carbon::now()->format('m-Y');
          $r = new Carbon($recibo->created_at);
          $existe = $d == $r->format('m-Y') ? true : false;
        }
        return view('admin.recibos.index', compact('recibos', 'existe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meses = array('1' => 'Enero',
                       '2' => 'Febrero',
                       '3' => 'Marzo',
                       '4' => 'Abril',
                       '5' => 'Mayo',
                       '6' => 'Junio',
                       '7' => 'Julio',
                       '8' => 'Agosto',
                       '9' => 'Septiembre',
                       '10' => 'Octubre',
                       '11' => 'Noviembre',
                       '12' => 'Diciembre');

        $month = Carbon::now()->format('m');
        foreach ($meses as $key => $mes) {
            if($key == $month){

                $month = $mes;

            }
        }

        $year = Carbon::now()->format('Y');

        $gastos = Gasto::where('estatus', true)->get();
        $fondo = Fondo::find(1);
        return view('admin.recibos.create', compact('gastos', 'month', 'fondo', 'year'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        extract($request->all());

        $propietarios = Propietario::all();
        $propietarios->each(function($propietarios){
            $propietarios->recibos;
        });

        $recibo = new Recibo($request->all());
        $fondo_reserva = Fondo::find(1);
        $subtotal = 0;
        $total = 0;
        $fondo = 0;
        $porcentaje = 0;
        $cuota = 0;

        foreach ($request->gastos_id as $key => $gasto)
        {
            if ($gasto == 9)
            {
              AcumuladoPrestaciones($importe[$key]);
            }
            $subtotal = $request->importe[$key] + $subtotal;
        }

        if($request->gasto_extra)
        {
            foreach ($request->gasto_extra as $key => $value)
            {
                $subtotal = $request->importe_extra[$key] + $subtotal;
            }
        }

        if($request->operacion){
              $recibo->subtotal = round($subtotal, 2);
              $recibo->fondo = ($subtotal * $request->valor) / 100;
              $recibo->subcuota = round($subtotal / 44, 2);
              $recibo->cuota_fondo = round($recibo->fondo / 44, 2);
              $recibo->total = round($subtotal + $recibo->fondo, 2);
              $recibo->cuota = round($recibo->total / 44, 2);
              $recibo->porcentaje = $request->valor;
              $recibo->operacion = '+';

              if($fondo_reserva->reserva > '0')
              {
                  $fondo_reserva->reserva = $fondo_reserva->reserva + $recibo->fondo;
              }else
              {
                  $fondo_reserva->reserva = $recibo->fondo;
              }

            }else{
              // Si no hay operación para el fondo de reserva
                $recibo->subtotal = round($subtotal, 2);
                $recibo->subcuota = round($subtotal / 44, 2);
                $recibo->fondo = 0;
                $recibo->porcentaje = 0;
                $recibo->operacion = '';
                $recibo->total = round($subtotal, 2);
                $recibo->cuota = $recibo->subcuota;
            }

        // GUARDO RECIBO
        $recibo->save();

        // PONIENDOLE MORA A LOS QUE DEBEN MAS DE TRES RECIBOS
        foreach ($propietarios as $key => $propietario)
        {
          $mora = 0;
          foreach($propietario->recibos()->get() as $recibos)
          {
            if($recibos->pivot->estatus)
            {
              $mora++;
            }
          }
          $estatus = $mora >= 2 ? true : false;
          $propietario->recibos()->attach([$recibo->id => ['mora' => $estatus]]);
        }

        // Realacionando los gastos con el recibo y guardando el importe
        foreach ($request->gastos_id as $key => $gasto)
        {
            if ($gasto == 9) {
              $recibo->gastos()->attach([$gasto => ['importe' => round($request->importe[$key], 2), 'estatus' => false]]);
            }else
            {
              $recibo->gastos()->attach([$gasto => ['importe' => round($request->importe[$key], 2)]]);
            }
        }

        if ($request->gasto_extra)
        {
           foreach ($request->gasto_extra as $key => $gasto)
           {
                $gasto_extra = new Gasto_extra();
                $gasto_extra->gasto_extra = $gasto;
                $gasto_extra->save();

                $recibo->gastos_extra()->attach([$gasto_extra->id => ['importe' => round($request->importe_extra[$key])]]);
            }
        }


        Flash::success('<strong>¡Perfecto!</strong> Se creo en recibo del mes de <strong>'.$recibo->mes.'</strong>');

        return redirect('admin/recibos');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function charge($id)
    {
      $recibo = Recibo::findOrFail($id);
      $propietarios = $recibo->propietarios()->get();
      return view('admin.recibos.charge', compact('recibo', 'propietarios'));
    }

    /**
    * PAGO DE LOS RECIBOS
    *
    */

    public function payment(Request $request)
    {
      foreach ($request->propietarios as $propietario_id) {

        $propietario = Propietario::find($propietario_id);
        $recibo = $propietario->recibos()->where('recibo_id', $request->recibo_id)->get();
        $recibo[0]->pivot->estatus = false;
        $recibo[0]->pivot->save();
        $recibo[0]->editar = false;
        $recibo[0]->save();

        $movimiento = new Movimiento();
        $movimiento->transaccion = 'Pago del recibo de '.$recibo[0]->mes.'-'.$recibo[0]->anio.' del apartamento '.$propietario->apartamentos[0]->numero;
        $movimiento->monto = $recibo[0]->pivot->mora ? $recibo[0]->subcuota + ($recibo[0]->cuota * 0.10) : $recibo[0]->subcuota;
        $saldo = Saldo::find(1);
        $movimiento->saldo = $saldo->saldo + $movimiento->monto;
        $saldo->saldo = $saldo->saldo + $movimiento->monto;
        $movimiento->save();
        $saldo->save();

        if($recibo[0]->operacion == '+'){
          $fondo = Fondo::find(1);
          $movimiento_fondo = new Movimiento_fondo();
          $movimiento_fondo->transaccion = 'Pago del recibo de '.$recibo[0]->mes.'-'.$recibo[0]->anio.' del apartamento '.$propietario->apartamentos[0]->numero;
          $movimiento_fondo->monto = $recibo[0]->cuota_fondo;
          $movimiento_fondo->saldo_fondo = $fondo->real + $recibo[0]->cuota_fondo;
          $movimiento_fondo->save();
          $fondo->real = $fondo->real + $recibo[0]->cuota_fondo;
          $fondo->save();
        }
      }

      Flash::success('<strong>¡Perfecto!</strong> Se registraron los pagos del recibo');

      return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recibo = Recibo::find($id);
        $gastos = $recibo->gastos()->get();
        $gastos_extra = $recibo->gastos_extra()->get();
        $fondo = Fondo::find(1);

        return view('admin.recibos.show', compact('recibo', 'gastos', 'gastos_extra', 'fondo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $recibo = Recibo::find($id);
      $gastos = $recibo->gastos()->get();
      $gastos_extra = $recibo->gastos_extra()->get();

      return view('admin.recibos.edit', compact('recibo', 'gastos', 'gastos_extra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $recibo = Recibo::find($id);

      $recibo->gastos()->detach();
      $recibo->gastos_extra()->detach();
      $subtotal = 0;

      foreach ($request->gastos_id as $key => $gasto) {
          $recibo->gastos()->attach([$gasto => ['importe' => round($request->importe[$key], 2)]]);

          // subtotal
          $subtotal = $subtotal + $request->importe[$key];
      }

      if($request->gasto_extra){
        foreach ($request->gasto_extra as $key => $gasto) {
            $gasto_extra = new Gasto_extra();
            $gasto_extra->gasto_extra = $gasto;
            $gasto_extra->save();
            $recibo->gastos_extra()->attach([$gasto_extra->id => ['importe' => round($request->importe_extra[$key])]]);

            //subtotal
            $subtotal = $subtotal + $request->importe_extra[$key];
          }
        }

        if($request->gastoExtra){
          foreach ($request->gastoExtra as $key => $gastoExtra) {

              $recibo->gastos_extra()->attach([$gastoExtra => ['importe' => round($request->importeExtra[$key])]]);

            // subtotal
              $subtotal = $subtotal + $request->importeExtra[$key];
            }
          }

          $recibo->observaciones = $request->observaciones;
          $recibo->subtotal = $subtotal;
          if($recibo->porcentaje == ''){
              // Recaudo o Desciento por en BS
              $total = $subtotal + $recibo->fondo;
          }else{
            // Recaudo por %
            if($recibo->operacion == '+'){
              $recibo->fondo = $subtotal * $recibo->porcentaje / 100;
              $total = $subtotal + $recibo->fondo;

            }else{
              //Descuento por %
              $recibo->fondo = $subtotal * $recibo->porcentaje / 100;
              $recibo->fondo = $recibo->fondo * -1;
              $total = $subtotal + $recibo->fondo;
            }
          }

          $recibo->total = $total;
          $recibo->subcuota = round($subtotal / 44, 2);
          $recibo->cuota_fondo = round($recibo->fondo / 44, 2);
          $recibo->cuota = round($total / 44, 2);
          $recibo->save();

          Flash::success('<strong>¡Perfecto!</strong> Se modifico el recibo de correctamente');

          return redirect()->route('admin.recibos.show', $recibo->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
