<?php

namespace App\Http\Controllers;

use App\Models\VisitanteAlerta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitanteAlertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitanteAlerta = VisitanteAlerta::with(['Visitante', 'Visita', 'TipoAlerta', 'Status', 'Usuario'])
                    ->get();
        
        return $visitanteAlerta;
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
            'id_visitante'      => 	'required|integer|max:10',
			'id_tipo_alerta'    => 	'required|integer|max:10',
			'id_visita'         => 	'required|integer|max:10',
			'id_status'         => 	'required|integer|max:10',
			'id_usuario'        => 	'required|integer|max:10',
			'tx_motivo_alerta'  => 	'required|alpha_num|max:255',
			'tx_anulacion'      => 	'required|alpha_num|max:255',
        ]);

        $visitanteAlerta = visitanteAlerta::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('visitanteAlerta') ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisitanteAlerta  $visitanteAlerta
     * @return \Illuminate\Http\Response
     */
    public function show(VisitanteAlerta $visitanteAlerta)
    {
        return $visitanteAlerta;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisitanteAlerta  $visitanteAlerta
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitanteAlerta $visitanteAlerta)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisitanteAlerta  $visitanteAlerta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitanteAlerta $visitanteAlerta)
    {
        $validate = request()->validate([
            'id_visitante_alerta'=> 	'required|integer|max:10',
			'id_visitante'      => 	'required|integer|max:10',
			'id_tipo_alerta'    => 	'required|integer|max:10',
			'id_visita'         => 	'required|integer|max:10',
			'id_status'         => 	'required|integer|max:10',
			'id_usuario'        => 	'required|integer|max:10',
			'tx_motivo_alerta'  => 	'required|alpha_num|max:255',
			'tx_anulacion'      => 	'required|alpha_num|max:255',
        ]);

        $visitanteAlerta = $visitanteAlerta->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('visitanteAlerta')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitanteAlerta  $visitanteAlerta
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitanteAlerta $visitanteAlerta)
    {
        $visitanteAlerta = $visitanteAlerta->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('visitanteAlerta')];
    }
}
