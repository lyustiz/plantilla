<?php

namespace App\Http\Controllers\Fas;

use App\Http\Models\Fas\Siniestro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiniestroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Siniestro::with('tramite')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $siniestro = Siniestro::create($request->all());

        return [
            'msj'=> 'Registro almacenado Correctamente',  
            compact('siniestro') 
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Fas\Siniestro  $siniestro
     * @return \Illuminate\Http\Response
     */
    // public function show(Siniestro $siniestro)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Fas\Siniestro  $siniestro
     * @return \Illuminate\Http\Response
     */
    // public function edit(Siniestro $siniestro)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Fas\Siniestro  $siniestro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siniestro $siniestro)
    {
        return [
            'respuesta' => $siniestro->update($request->all()),
            'msj'=> 'Registro actualizado correctamente'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Fas\Siniestro  $siniestro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siniestro $siniestro)
    {
        return [
            'Registro eliminado' => $siniestro->delete(),
            'msj'=> 'Registro eliminado'
        ];
    }
}
