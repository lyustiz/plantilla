<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresa::with(['Status', 'Usuario'])
                    ->get();
        
        return $empresa;
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
			'nb_empresa'        => 	'required|alpha_num|max:100',
			'tx_rif'            => 	'required|alpha_num|max:15',
			'tx_direccion'      => 	'required|alpha_num|max:300',
			'tx_telefono'       => 	'required|alpha_num|max:100',
			'tx_contacto'       => 	'required|alpha_num|max:80',
			'tx_correo'         => 	'required|alpha_num|max:50',
			'id_tipo_empresa'   => 	'required|integer|max:10',
			'id_pais'           => 	'required|integer|max:10',
			'id_region1'        => 	'required|integer|max:10',
			'id_region2'        => 	'required|integer|max:10',
			'id_region3'        => 	'required|integer|max:10',
			'tx_observaciones'  => 	'required|alpha_num|max:200',
			'id_empresa_ppal'   => 	'required|integer|max:10',
        ]);

        $empresa = empresa::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('empresa') ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        return $empresa;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        $validate = request()->validate([
            'id_empresa'        => 	'required|alpha_num|max:',
			'id_status'         => 	'required|integer|max:10',
			'id_usuario'        => 	'required|integer|max:10',
			'nb_empresa'        => 	'required|alpha_num|max:100',
			'tx_rif'            => 	'required|alpha_num|max:15',
			'tx_direccion'      => 	'required|alpha_num|max:300',
			'tx_telefono'       => 	'required|alpha_num|max:100',
			'tx_contacto'       => 	'required|alpha_num|max:80',
			'tx_correo'         => 	'required|alpha_num|max:50',
			'id_tipo_empresa'   => 	'required|integer|max:10',
			'id_pais'           => 	'required|integer|max:10',
			'id_region1'        => 	'required|integer|max:10',
			'id_region2'        => 	'required|integer|max:10',
			'id_region3'        => 	'required|integer|max:10',
			'tx_observaciones'  => 	'required|alpha_num|max:200',
			'id_empresa_ppal'   => 	'required|integer|max:10',
        ]);

        $empresa = $empresa->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('empresa')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa = $empresa->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('empresa')];
    }
}
