<?php

namespace App\Http\Controllers\General;

use App\Http\Models\General\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cliente::orderBy('nb_cliente', 'asc')
            ->with(
            'tipo:id_tipo_cliente,nb_tipo_cliente',
            'clase:id_clase_cliente,nb_clase_cliente',
            'status:id_status,nb_status'
            )->get();
    }

    public function clienteGrupo($grupo)
    {
        return Cliente::select('id_cliente','nb_cliente','tx_rif')
                        ->grupo($grupo)
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
       /* $data=request()->validate([
        'nb_cliente'        => 'required',
        'tx_rif'            => 'required',
        'tx_direccion'      => 'required',
        'tx_tlefono'        => 'required',
        'tx_contacto'       => 'required',      
        'tx_email'          => 'required',      
        'id_tipo_cliente'   => 'required',      
        'id_clase_cliente'  => 'required',       
        'tx_observaciones'  => 'required',      
        'id_status'         => 'required',      
        'id_tipo'           => 'required',      
        'id_usuario'        => 'required',      
        'fe_creado'         => 'required',      
        'fe_actualizado'    => 'required'
        ]);
        */
        $cliente = Cliente::create($request->all());
        return [
            'msj'=> 'Registro almacenado Correctamente',  
            compact('cliente') 
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Dicom\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Dicom\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Dicom\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        return [
            'respuesta' => $cliente->update($request->all()),
            'msj'=> 'Registro actualizado correctamente'
        ];
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Dicom\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        return [
            'Registro eliminado' => $cliente->delete(),
            'msj'=> 'Registro eliminado'
        ];
    }
}
