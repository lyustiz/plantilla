<?php

namespace App\Http\Controllers\Facturero;

use App\Http\Models\Facturero\EmpresasContratistas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpresasContratistasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $empresa = EmpresasContratistas::with('banco')
        ->orderBy('id_empresa_contratista', 'asc')
        ->get();
        //dd($empresa);
        return $empresa;
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
     * @param  \App\Http\Models\Facturero\EmpresasContratistas  $empresasContratistas
     * @return \Illuminate\Http\Response
     */
    public function show(EmpresasContratistas $empresasContratistas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Facturero\EmpresasContratistas  $empresasContratistas
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpresasContratistas $empresasContratistas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Facturero\EmpresasContratistas  $empresasContratistas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpresasContratistas $empresasContratistas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Facturero\EmpresasContratistas  $empresasContratistas
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpresasContratistas $empresasContratistas)
    {
        //
    }
}
