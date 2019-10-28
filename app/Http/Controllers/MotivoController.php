<?php

namespace App\Http\Controllers;

use App\Models\Motivo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MotivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motivo = Motivo::with(['Status', 'Usuario'])
                    ->get();
        
        return $motivo;
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
			'nb_motivo'         => 	'required|alpha_num|max:255',
        ]);

        $motivo = motivo::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('motivo') ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function show(Motivo $motivo)
    {
        return $motivo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Motivo $motivo)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motivo $motivo)
    {
        $validate = request()->validate([
            'id_motivo'         => 	'required|integer|max:10',
			'id_status'         => 	'required|integer|max:10',
			'id_usuario'        => 	'required|integer|max:10',
			'nb_motivo'         => 	'required|alpha_num|max:255',
        ]);

        $motivo = $motivo->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('motivo')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motivo $motivo)
    {
        $motivo = $motivo->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('motivo')];
    }
}
