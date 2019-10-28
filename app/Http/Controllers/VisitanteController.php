<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitante = Visitante::with(['Visitante', 'Status', 'Usuario'])
                    ->get();
        
        return $visitante;
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
			'tx_nombres'        => 	'required|alpha_num|max:50',
			'tx_apellidos'      => 	'required|alpha_num|max:50',
			'nu_cedula'         => 	'required|alpha_num|max:10',
			'tx_nacionalidad'   => 	'required|alpha_num|max:1',
			'tx_foto'           => 	'required|alpha_num|max:255',
			'tx_cod_pais'       => 	'required|alpha_num|max:255',
			'tx_telefono'       => 	'required|alpha_num|max:20',
        ]);

        $visitante = visitante::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('visitante') ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function show(Visitante $visitante)
    {
        return $visitante;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitante $visitante)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitante $visitante)
    {
        $validate = request()->validate([
            'id_visitante'      => 	'required|integer|max:10',
			'id_status'         => 	'required|integer|max:10',
			'id_usuario'        => 	'required|integer|max:10',
			'tx_nombres'        => 	'required|alpha_num|max:50',
			'tx_apellidos'      => 	'required|alpha_num|max:50',
			'nu_cedula'         => 	'required|alpha_num|max:10',
			'tx_nacionalidad'   => 	'required|alpha_num|max:1',
			'tx_foto'           => 	'required|alpha_num|max:255',
			'tx_cod_pais'       => 	'required|alpha_num|max:255',
			'tx_telefono'       => 	'required|alpha_num|max:20',
        ]);

        $visitante = $visitante->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('visitante')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitante $visitante)
    {
        $visitante = $visitante->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('visitante')];
    }
}
