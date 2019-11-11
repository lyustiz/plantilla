<?php

namespace App\Http\Controllers\Dicom;

use App\Http\Models\Dicom\DetSolicitud;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetSolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DetSolicitud::all();
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
        $detSolicitud = DetSolicitud::create($request->all());

        return [
            'msj'=> 'Registro almacenado Correctamente',  
            compact('solicitud') 
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Dicom\DetSolicitud  $detSolicitud
     * @return \Illuminate\Http\Response
     */
    public function show(DetSolicitud $detSolicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Dicom\DetSolicitud  $detSolicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(DetSolicitud $detSolicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Dicom\DetSolicitud  $detSolicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetSolicitud $detsolicitud)
    {
        // dd($request->all(),$detsolicitud);
        return [
            'updated' => $detsolicitud->update($request->all()),
            'msj'=> 'Registro actualizado Correctamente',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Dicom\DetSolicitud  $detSolicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetSolicitud $detsolicitud)
    {
        // $detSolicitud=DetSolicitud::find($id);
        return [
            'deleted' => $detsolicitud->delete(),
            'msj'=> 'Registro eliminado Correctamente',
        ];
    }
}
