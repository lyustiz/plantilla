<?php

namespace App\Http\Controllers\General;

use App\Http\Models\General\Banco;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Banco::orderBy('nb_banco', 'asc')
            ->with(
            'tipo:id_tipo_banco,nb_tipo_banco'
            )->get();
    }


    public function bancoGrupo($grupo)
    {
        return Banco::select('id_banco','nb_banco','co_banco')
                        // ->grupo($grupo)
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
        $banco = Banco::create($request->all());

        return [
            'msj'=> 'Registro almacenado Correctamente',  
            compact('banco') 
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\General\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function show(Banco $banco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\General\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function edit(Banco $banco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\General\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banco $banco)
    {
        return [
            'respuesta' => $banco->update($request->all()),
            'msj'=> 'Registro actualizado correctamente'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\General\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banco $banco)
    {
        return [
            'Registro eliminado' => $banco->delete(),
            'msj'=> 'Registro eliminado'
        ];
    }
}
