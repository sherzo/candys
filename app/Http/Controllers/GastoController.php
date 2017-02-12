<?php

namespace App\Http\Controllers;

use App\Gasto;
use App\Gasto_extra;
use App\Movimiento;
use App\Saldo;
use App\Http\Requests;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gastos = Gasto::all();
        return view('admin.gastos.index', compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'gasto' => 'required',
        ]);

        $gasto = Gasto::create($request->all());

        Flash::success('<strong>¡Perfecto!</strong> Se registro el gasto <strong>'.$gasto->gasto.'</strong>');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function pay(Request $request)
     {
       $gasto = $request->extra ? Gasto_extra::find($request->gasto_id) : Gasto::find($request->gasto_id);
       $recibo = $gasto->recibos()->where('recibo_id', $request->recibo_id)->first();

       $saldo = Saldo::first();

       if ($saldo->saldo < $request->monto)
       {
          Flash::error('<strong>¡Cuidado!</strong> el monto que desea abonar es mayor al saldo disponible');
          return redirect()->back();

       }

       if ($request->monto > $recibo->pivot->importe)
       {
         Flash::error('<strong>¡Cuidado!</strong> el monto que desea abonar es mayor al gasto que desea cancelar');
         return redirect()->back();
       }

       if ($request->monto == $recibo->pivot->importe) {
         $recibo->pivot->estatus = false;
       }else{
         $recibo->pivot->importe = $recibo->pivot->importe - $request->monto;
       }

       $recibo->editar = false;
       $recibo->save();
       $recibo->pivot->save();

       $saldo->saldo = $saldo->saldo - $request->monto;
       $saldo->save();
       $movimiento = new Movimiento();
       $movimiento->transaccion = 'Abono al gasto '.$gasto->gasto.' del mes '.$recibo->mes.' del '.$recibo->anio;
       $movimiento->monto = $request->monto;
       $movimiento->signo = '-';
       $movimiento->saldo = $saldo->saldo;
       $movimiento->save();

       Flash::success('<strong>¡Perfecto!</strong> se abonaron <strong>'.$request->monto.'</strong> bs al gasto');
       return redirect()->back();

     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function payment($gasto_id, $recibo_id, $extra)
     {
       $gasto = $extra ? Gasto_extra::find($gasto_id) : Gasto::find($gasto_id);
       $recibo = $gasto->recibos()->where('recibo_id', $recibo_id)->get();
       $recibo[0]->pivot->estatus = false;
       $recibo[0]->editar = false;
       $recibo[0]->save();

       $movimiento = new Movimiento();
       if($extra){
         $movimiento->transaccion = 'Pago del gasto '.$gasto->gasto_extra.' del recibo '.$recibo[0]->mes.'-'.$recibo[0]->anio;
       }else{
         $movimiento->transaccion = 'Pago del gasto '.$gasto->gasto.' del recibo '.$recibo[0]->mes.'-'.$recibo[0]->anio;
       }
       $movimiento->monto = $recibo[0]->pivot->importe;
       $saldo = Saldo::find(1);
       $movimiento->saldo = $saldo->saldo - $movimiento->monto;
       $movimiento->signo = '-';
       if($movimiento->monto > $saldo->saldo){
         Flash::error('<strong>¡Cuidado!</strong> El monto que desea cancelar es mayor al saldo disponible | Monto: <strong>'.$movimiento->monto.'</strong> Saldo: <strong>'.$saldo->saldo.'</strong>');

         return redirect()->back();
       }
       $saldo->saldo = $saldo->saldo - $movimiento->monto;
       $movimiento->save();
       $saldo->save();
       $recibo[0]->pivot->save();

       Flash::success('<strong>¡Perfecto!</strong> Se registro el pago');

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
        $gastos = Gasto::all();
        $gastoedit = Gasto::find($id);


        return view('admin.gastos.index', compact('gastos', 'gastoedit'));
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
        $gasto = Gasto::find($id);
        $gasto->fill($request->all());
        $gasto->save();

        Flash::success('<strong>¡Perfecto!</strong> el gasto <strong>'. $gasto->gasto .'</strong> se modifico correctamente');

        return redirect('admin/gastos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gasto = Gasto::find($id);
        $gasto->delete();

        Flash::success('<strong>¡Perfecto!</strong> el gasto <strong>'. $gasto->gasto .'</strong> fue eliminado correctamente');

        return redirect()->back();
    }
}
