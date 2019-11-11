<?php

namespace App\Http\Controllers\General;

use App\Http\Models\General\Operacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OperacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Operacion::all();
    }

    public function operacionGrupo($grupo)
    {
        return  Operacion::select('id_operacion','nb_operacion')
                        // ->grupo($grupo)
                        ->get();
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
        
        $operacion = Operacion::create($request->all());

        return [
            'msj'=> 'Registro almacenado Correctamente',  
            compact('operacion') 
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\General\Operacion  $operacion
     * @return \Illuminate\Http\Response
     */
    public function show(Operacion $operacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\General\Operacion  $operacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Operacion $operacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\General\Operacion  $operacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operacion $operacion)
    {
        return [
            'respuesta' => $operacion->update($request->all())
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\General\Operacion  $operacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operacion=Operacion::find($id)->delete();
        return [
            'msj'=> 'Registro eliminado Correctamente',  
            compact('operacion') 
        ];
    }
}
