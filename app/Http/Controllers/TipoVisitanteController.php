<?php

namespace App\Http\Controllers;

use App\Models\TipoVisitante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoVisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoVisitante = TipoVisitante::with(['Status', 'Usuario'])
                    ->get();
        
        return $tipoVisitante;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = request()->validate([
            'id_status'         => 	'required|integer|max:10',
			'id_usuario'        => 	'required|integer|max:10',
			'nb_tipo_visitante' => 	'required|alpha_num|max:255',
        ]);

        $tipoVisitante = tipoVisitante::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('tipoVisitante') ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoVisitante  $tipoVisitante
     * @return \Illuminate\Http\Response
     */
    public function show(TipoVisitante $tipoVisitante)
    {
        return $tipoVisitante;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoVisitante  $tipoVisitante
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoVisitante $tipoVisitante)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoVisitante  $tipoVisitante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoVisitante $tipoVisitante)
    {
        $validate = request()->validate([
            'id_tipo_visitante' => 	'required|integer|max:10',
			'id_status'         => 	'required|integer|max:10',
			'id_usuario'        => 	'required|integer|max:10',
			'nb_tipo_visitante' => 	'required|alpha_num|max:255',
        ]);

        $tipoVisitante = $tipoVisitante->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('tipoVisitante')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoVisitante  $tipoVisitante
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoVisitante $tipoVisitante)
    {
        $tipoVisitante = $tipoVisitante->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('tipoVisitante')];
    }
}
