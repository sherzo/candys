<?php

namespace App\Http\Controllers;

use App\Gasto;
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
