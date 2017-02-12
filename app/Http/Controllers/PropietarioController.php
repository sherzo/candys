<?php

namespace App\Http\Controllers;

use App\Apartamento;
use App\Http\Requests;
use App\Http\Requests\PropietarioRequest;
use App\Propietario;
use App\Recibo;
use App\Movimiento;
use App\Saldo;
use App\Fondo;
use App\Movimiento_fondo;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Validator;

class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propietarios = Propietario::all();

        $propietarios->each(function($propietarios){
            $propietarios->apartamentos;
        });

        return view('admin.propietarios.index', compact('propietarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apartamentos = Apartamento::where('estatus', 'Libre')->lists('numero', 'id');

        return view('admin.propietarios.create', compact('apartamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropietarioRequest $request)
    {
        $propietario = new Propietario($request->all());
        $propietario->save();

        foreach ($request->apartamentos as $key => $apartamento) {

            $propietario->apartamentos()->attach([$apartamento]);
            $apartamento = Apartamento::find($apartamento);
            $apartamento->estatus = 'Ocupado';
            $apartamento->save();

        }

        Flash::success('<strong>¡Perfecto!</strong> Se registro el propietario <strong>'.$propietario->nombre.'</strong>');

        return redirect('admin/propietarios');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function payment($propietario_id, $recibo_id)
     {
       $propietario = Propietario::find($propietario_id);
       $recibo = $propietario->recibos()->where('recibo_id', $recibo_id)->get();
       $recibo[0]->pivot->estatus = false;
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
       $recibo[0]->pivot->save();

       if($recibo[0]->operacion == '+')
       {
         $fondo = Fondo::find(1);
         $movimiento_fondo = new Movimiento_fondo();
         $movimiento_fondo->transaccion = 'Pago del recibo de '.$recibo[0]->mes.'-'.$recibo[0]->anio.' del apartamento '.$propietario->apartamentos[0]->numero;
         $movimiento_fondo->monto = $recibo[0]->cuota_fondo;
         $movimiento_fondo->saldo_fondo = $fondo->real + $recibo[0]->cuota_fondo;
         $movimiento_fondo->save();
         $fondo->real = $fondo->real + $recibo[0]->cuota_fondo;
         $fondo->save();
       }

       Flash::success('<strong>¡Perfecto!</strong> Se registo el pago del recibo');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $propietario = Propietario::find($id);

        return view('admin.propietarios.edit', compact('propietario'));
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

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $propietario = Propietario::findOrFail($id);

        $propietario->fill($request->all());
        $propietario->save();

        Flash::success('<strong>¡Perfecto!</strong> El propietario: <strong>'. $propietario->nombre. '</strong> se modifico correctamente');

        return redirect()->back();
    }

    public function morosos()
    {
      $propietarios = Propietario::all();
      $propietarios->each(function($propietarios){
        $propietarios->recibos;
      });
      return view('admin.propietarios.morosos', compact('propietarios'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propietario = Propietario::find($id);
        $propietario->each(function($propietario, $key){
            $propietario->apartamentos;
        });

        foreach ($propietario->apartamentos as $apartamento) {
            $apartamento->estatus = 'Libre';
            $apartamento->save();
        }

        $propietario->delete();

        Flash::success('<strong>¡Perfecto!</strong> el propietario <strong>'. $propietario->nombre .'</strong> fue eliminado correctamente');

        return redirect()->back();
    }

}
