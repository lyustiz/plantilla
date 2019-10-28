<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visita = Visita::with(['Visitante', 'TipoVisitante', 'Empresa', 'Motivo', 'Status', 'Usuario'])
                    ->get();
        
        return $visita;
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
			'id_tipo_visitante' => 	'required|integer|max:10',
			'id_empresa'        => 	'required|integer|max:10',
			'id_motivo'         => 	'required|integer|max:10',
			'id_status'         => 	'required|integer|max:10',
			'id_usuario'        => 	'required|integer|max:10',
			'nu_ced_empleado'   => 	'required|integer|max:10',
			'tx_cargo'          => 	'required|alpha_num|max:',
			'tx_observaciones'  => 	'required|alpha_num|max:500',
			'nu_carnet'         => 	'required|numeric|max:5',
			'fe_entrada'        => 	'required|date',
			'fe_salida'         => 	'required|date',
        ]);

        $visita = visita::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('visita') ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function show(Visita $visita)
    {
        return $visita;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function edit(Visita $visita)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visita $visita)
    {
        $validate = request()->validate([
            'id_visita'         => 	'required|integer|max:10',
			'id_visitante'      => 	'required|integer|max:10',
			'id_tipo_visitante' => 	'required|integer|max:10',
			'id_empresa'        => 	'required|integer|max:10',
			'id_motivo'         => 	'required|integer|max:10',
			'id_status'         => 	'required|integer|max:10',
			'id_usuario'        => 	'required|integer|max:10',
			'nu_ced_empleado'   => 	'required|integer|max:10',
			'tx_cargo'          => 	'required|alpha_num|max:',
			'tx_observaciones'  => 	'required|alpha_num|max:500',
			'nu_carnet'         => 	'required|numeric|max:5',
			'fe_entrada'        => 	'required|date',
			'fe_salida'         => 	'required|date',
        ]);

        $visita = $visita->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('visita')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visita $visita)
    {
        $visita = $visita->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('visita')];
    }
}
