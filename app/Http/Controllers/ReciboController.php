<?php

namespace App\Http\Controllers;

use App\Gasto;
use App\Http\Requests;
use App\Recibo;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        return view('admin.recibos.create', compact('gastos', 'month'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
