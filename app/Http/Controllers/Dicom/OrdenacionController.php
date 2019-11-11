<?php

namespace App\Http\Controllers\Dicom;

use App\Http\Models\Dicom\Ordenacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdenacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Returns 'Ordenaciones' by id with related 'Detalles'
     * @param Array $id id of 'Ordenacion'
     */
    public function obtenerOrdenacion($id){

        return Ordenacion::with('detallesOrdenacion')
                            ->where('id_ordenacion', $id)
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Dicom\Ordenacion  $ordenacion
     * @return \Illuminate\Http\Response
     */
    public function show(Ordenacion $ordenacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Dicom\Ordenacion  $ordenacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordenacion $ordenacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Dicom\Ordenacion  $ordenacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordenacion $ordenacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Dicom\Ordenacion  $ordenacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordenacion $ordenacion)
    {
        //
    }
}
