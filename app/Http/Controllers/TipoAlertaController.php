<?php

namespace App\Http\Controllers;

use App\Models\TipoAlerta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoAlertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoAlerta = TipoAlerta::with(['Status', 'Usuario'])
                    ->get();
        
        return $tipoAlerta;
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
			'nb_tipo_alerta'    => 	'required|alpha_num|max:50',
			'nu_nivel_alerta'   => 	'required|integer|max:10',
			'tx_accion'         => 	'required|alpha_num|max:200',
			'tx_imagen'         => 	'required|alpha_num|max:255',
        ]);

        $tipoAlerta = tipoAlerta::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('tipoAlerta') ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoAlerta  $tipoAlerta
     * @return \Illuminate\Http\Response
     */
    public function show(TipoAlerta $tipoAlerta)
    {
        return $tipoAlerta;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoAlerta  $tipoAlerta
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoAlerta $tipoAlerta)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoAlerta  $tipoAlerta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoAlerta $tipoAlerta)
    {
        $validate = request()->validate([
            'id_tipo_alerta'    => 	'required|integer|max:10',
			'id_status'         => 	'required|integer|max:10',
			'id_usuario'        => 	'required|integer|max:10',
			'nb_tipo_alerta'    => 	'required|alpha_num|max:50',
			'nu_nivel_alerta'   => 	'required|integer|max:10',
			'tx_accion'         => 	'required|alpha_num|max:200',
			'tx_imagen'         => 	'required|alpha_num|max:255',
        ]);

        $tipoAlerta = $tipoAlerta->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('tipoAlerta')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoAlerta  $tipoAlerta
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoAlerta $tipoAlerta)
    {
        $tipoAlerta = $tipoAlerta->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('tipoAlerta')];
    }
}
