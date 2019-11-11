<?php

namespace App\Http\Controllers\Facturero;

use App\Http\Models\Facturero\EntesEjecutores;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class EntesEjecutoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return EntesEjecutores::orderBy('id_ente_ejecutor', 'asc')
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
        //
        $enteEjecutor = EntesEjecutores::create($request->all());

        return [
            'msj'=> 'Registro almacenado Correctamente',  
            compact('EntesEjecutores') 
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Facturero\EntesEjecutores  $entesEjecutores
     * @return \Illuminate\Http\Response
     */
    public function show(EntesEjecutores $entesEjecutores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Facturero\EntesEjecutores  $entesEjecutores
     * @return \Illuminate\Http\Response
     */
    public function edit(EntesEjecutores $entesEjecutores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Facturero\EntesEjecutores  $entesEjecutores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntesEjecutores $enteEjecutor)
    {
        //
        return [
            'respuesta' => $enteEjecutor->update($request->all()),
            'msj'=> 'Registro actualizado correctamente'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Facturero\EntesEjecutores  $entesEjecutores
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntesEjecutores $enteEjecutor)
    {
        //
        return [
            'Registro eliminado' => $enteEjecutor->delete(),
            'msj'=> 'Registro eliminado'
        ];
    }
}
