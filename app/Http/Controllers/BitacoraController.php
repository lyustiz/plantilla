<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bitacora = Bitacora::with(['Usuario'])
                    ->get();
        
        return $bitacora;
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
            'id_usuario'        => 	'required|integer|max:10',
			'co_accion'         => 	'required|alpha_num|max:3',
			'tx_tabla'          => 	'required|alpha_num|max:255',
			'in_id_tabla'       => 	'required|integer|max:10',
			'tx_old_valor'      => 	'required|alpha_num|max:500',
			'tx_new_valor'      => 	'required|alpha_num|max:500',
			'fe_accion'         => 	'required|date',
        ]);

        $bitacora = bitacora::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('bitacora') ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bitacora  $bitacora
     * @return \Illuminate\Http\Response
     */
    public function show(Bitacora $bitacora)
    {
        return $bitacora;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bitacora  $bitacora
     * @return \Illuminate\Http\Response
     */
    public function edit(Bitacora $bitacora)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bitacora  $bitacora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bitacora $bitacora)
    {
        $validate = request()->validate([
            'id_bitacora'       => 	'required|integer|max:10',
			'id_usuario'        => 	'required|integer|max:10',
			'co_accion'         => 	'required|alpha_num|max:3',
			'tx_tabla'          => 	'required|alpha_num|max:255',
			'in_id_tabla'       => 	'required|integer|max:10',
			'tx_old_valor'      => 	'required|alpha_num|max:500',
			'tx_new_valor'      => 	'required|alpha_num|max:500',
			'fe_accion'         => 	'required|date',
        ]);

        $bitacora = $bitacora->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('bitacora')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bitacora  $bitacora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bitacora $bitacora)
    {
        $bitacora = $bitacora->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('bitacora')];
    }
}
