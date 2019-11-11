<?php

namespace App\Http\Controllers\Dicom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Dicom\Subasta;


class SubastaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Subasta::with('status:id_status,nb_status')
                        ->orderBy('fe_subasta', 'desc')
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

        
        /*
        $data=request()->validate([
        'nu_subasta'        => 'required',
        'co_subasta'        => 'required',
        'fe_subasta'        => 'required',
        'fe_cierre'         => 'required',
        'fe_adjudicacion'   => 'requied',
        'fe_publicacion'    => 'required',
        'fe_liquidacion'    => 'required',
        'fe_valor'          => 'required',
        'id_status'         => 'required',
        'id_tipo'           => 'required',
        'id_usuario'        => 'required',
        'fe_creado'         => 'required',
        'fe_actualizado'    => 'required',
        ]);
        */
        
        $subasta = Subasta::create($request->all());

        return [
            'msj'=> 'Registro almacenado Correctamente',
            compact('subasta') 
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subasta  $subasta
     * @return \Illuminate\Http\Response
     */
    public function show(Subasta $subasta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subasta  $subasta
     * @return \Illuminate\Http\Response
     */
    public function edit(Subasta $subasta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subasta  $subasta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subasta $subastum)
    {
        return [
            'respuesta' => $subastum->update($request->all()),
            'msj'=> 'Registro actualizado correctamente'
        ];
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  \App\Subasta  $subasta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subasta $subastum)
    {
        return [
            'Registro eliminado' => $subastum->delete(),
            'msj'=> 'Registro eliminado'
        ];
    }
}
