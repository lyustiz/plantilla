<?php

namespace App\Http\Controllers\General;

use App\Http\Models\General\Moneda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Moneda::all();
    }

    public function monedaGrupo($grupo)
    {
        return Moneda::select('id_moneda','nb_moneda','co_bcv')
                        ->grupo($grupo)
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
        $moneda = Moneda::create($request->all());
        return [
            'msj'=> 'Registro almacenado Correctamente',  
            compact('moneda') 
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\General\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function show(Moneda $moneda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\General\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function edit(Moneda $moneda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\General\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Moneda $moneda)
    {
        return [
            'respuesta' => $moneda->update($request->all()),
            'msj'=> 'Registro actualizado correctamente'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\General\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moneda $moneda)
    {
        return [
            'Registro eliminado' => $moneda->delete(),
            'msj'=> 'Registro eliminado'
        ];
    }
}
