<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Usuario::with(['Status'])
                    ->get();
        
        return $usuario;
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
			'nb_usuario'        => 	'required|alpha_num|max:200',
			'password'          => 	'required|alpha_num|max:32',
			'tx_correo'         => 	'required|alpha_num|max:300',
			'nu_cedula'         => 	'required|alpha_num|max:12',
			'nb_p_nombre'       => 	'required|alpha_num|max:30',
			'nb_s_nombre'       => 	'required|alpha_num|max:30',
			'nb_p_apellido'     => 	'required|alpha_num|max:30',
			'nb_s_apellido'     => 	'required|alpha_num|max:30',
			'tx_nacionalidad'   => 	'required|alpha_num|max:1',
			'tx_rif'            => 	'required|alpha_num|max:12',
			'tx_telefono'       => 	'required|alpha_num|max:100',
			'id_usuario_c'      => 	'required|alpha_num|max:',
        ]);

        $usuario = usuario::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('usuario') ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return $usuario;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $validate = request()->validate([
            'id_usuario'        => 	'required|integer|max:10',
			'id_status'         => 	'required|integer|max:10',
			'nb_usuario'        => 	'required|alpha_num|max:200',
			'password'          => 	'required|alpha_num|max:32',
			'tx_correo'         => 	'required|alpha_num|max:300',
			'nu_cedula'         => 	'required|alpha_num|max:12',
			'nb_p_nombre'       => 	'required|alpha_num|max:30',
			'nb_s_nombre'       => 	'required|alpha_num|max:30',
			'nb_p_apellido'     => 	'required|alpha_num|max:30',
			'nb_s_apellido'     => 	'required|alpha_num|max:30',
			'tx_nacionalidad'   => 	'required|alpha_num|max:1',
			'tx_rif'            => 	'required|alpha_num|max:12',
			'tx_telefono'       => 	'required|alpha_num|max:100',
			'id_usuario_c'      => 	'required|alpha_num|max:',
        ]);

        $usuario = $usuario->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('usuario')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario = $usuario->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('usuario')];
    }
}
