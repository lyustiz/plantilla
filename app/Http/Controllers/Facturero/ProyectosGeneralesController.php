<?php

namespace App\Http\Controllers\Facturero;

use App\Http\Models\Facturero\ProyectosGenerales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProyectosGeneralesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $general = ProyectosGenerales::with('espesificos')
        ->orderBy('id_proyecto_general', 'asc')
        ->get();
        //dd($general);
        return $general;
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
     * @param  \App\Http\Models\Facturero\ProyectosGenerales  $proyectosGenerales
     * @return \Illuminate\Http\Response
     */
    public function show(ProyectosGenerales $proyectosGenerales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Facturero\ProyectosGenerales  $proyectosGenerales
     * @return \Illuminate\Http\Response
     */
    public function edit(ProyectosGenerales $proyectosGenerales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Facturero\ProyectosGenerales  $proyectosGenerales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProyectosGenerales $proyectosGenerales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Facturero\ProyectosGenerales  $proyectosGenerales
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProyectosGenerales $proyectosGenerales)
    {
        //
    }
}
