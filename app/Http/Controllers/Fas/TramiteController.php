<?php

namespace App\Http\Controllers\Fas;

use App\Http\Models\Fas\Tramite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tramite::with('siniestro')->get();
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
        $tramite = Tramite::create($request->all());

        return [
            'msj'=> 'Registro almacenado Correctamente',  
            compact('tramite') 
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Fas\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    // public function show(Tramite $tramite)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Fas\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    // public function edit(Tramite $tramite)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Fas\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tramite $tramite)
    {
        return [
            'respuesta' => $tramite->update($request->all()),
            'msj'=> 'Registro actualizado correctamente'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Fas\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tramite $tramite)
    {
        return [
            'Registro eliminado' => $tramite->delete(),
            'msj'=> 'Registro eliminado'
        ];
    }
}
