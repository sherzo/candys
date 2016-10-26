<?php

namespace App\Http\Controllers;

use App\Apartamento;
use App\Http\Requests;
use App\Http\Requests\PropietarioRequest;
use App\Propietario;
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
            'telefono' => 'required',
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
