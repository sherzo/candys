<?php

namespace App\Http\Controllers;

use App\Fondo;
use App\Gasto;
use App\Gasto_extra;
use App\Http\Requests;
use App\Recibo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

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
        return view('admin.recibos.index', compact('recibos'));
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

        $gastos = Gasto::all();
        $fondo = Fondo::find(1);
        return view('admin.recibos.create', compact('gastos', 'month', 'fondo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recibo = new Recibo($request->all());
        $subtotal = 0;
        $total = 0;
        $fondo = 0;
        $cuota = 0;
        
        foreach ($request->gastos_id as $key => $gasto) {
            
            $subtotal = $request->importe[$key] + $subtotal;
        
        }

        if($request->gasto_extra){
            
            foreach ($request->gasto_extra as $key => $value) {

                $subtotal = $request->importe_extra[$key] + $subtotal;     
            }
        }

        
        
        if($request->operacion){

            if ($request->operacion == 1) {

                $fondo = ($subtotal * $request->valor) / 100;
                $total = $subtotal + $fondo;
                $cuota = $total / 44;
                

            }else if ($request->operacion == 2) {

                $fondo = ($subtotal * $request->valor) / 100;
                $total = $subtotal - $fondo;
                $cuota = $total / 44;
                
                
            }else if($request->operacion == 3){
                
                $fondo = $request->valor;
                $total = $subtotal + $fondo;
                $cuota = $total / 44;
    
            }else if($request->operacion == 4){

                $fondo = $request->valor;
                $total = $subtotal - $fondo;
                $cuota = $total / 44;
            
            }

            $recibo->subtotal = round($subtotal, 2);
            $recibo->fondo = round($fondo, 2);
            $recibo->total = round($total, 2);
            $recibo->cuota = round($cuota, 2);

        }else{

            $recibo->subtotal = round($subtotal, 2);
            $recibo->fondo = 0;
            $recibo->total = round($subtotal, 2);
            $cuota = $subtotal / 44;
            $recibo->cuota = round($cuota, 2);

        }

        $recibo->save();

        foreach ($request->gastos_id as $key => $gasto) {
            
            $recibo->gastos()->attach([$gasto => ['importe' => $request->importe[$key]]]);

        }

        if ($request->gasto_extra) {
           
           foreach ($request->gasto_extra as $key => $gasto) {
                
                $gasto_extra = new Gasto_extra();
                $gasto_extra->gasto_extra = $gasto;
                $gasto_extra->save();

                $recibo->gastos_extra()->attach([$gasto_extra->id => ['importe' => $request->importe_extra[$key]]]);

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
        //
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
        //
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
