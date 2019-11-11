<?php

namespace App\Http\Controllers\Dicom;

use App\Http\Models\Dicom\Solicitud;
use App\Http\Models\Dicom\DetSolicitud;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Solicitud::all();
    }

    /**
     * Returns 'Solicitudes' by id with related 'Detalles'
     * @param Array $id id of 'Solicitud'
     */
    public function obtenerSolicitudes($id){
        return Solicitud::with('detallesSolicitud')
                        ->where('id_subasta', $id)
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
        $solicitud = Solicitud::create($request->all());

        return ['msj'=> 'Registro almacenado Correctamente',  compact('solicitud') ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Dicom\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Dicom\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Dicom\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        return [
            'respuesta' => $solicitud->update($request->all())
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Dicom\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        // $solicitud=Solicitud::find($id);
        return [
            'respuesta' => $solicitud->delete()
        ];
    }
}
