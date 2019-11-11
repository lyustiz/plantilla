<?php

namespace App\Http\Controllers\ControlPerceptivo;

use App\Http\Controllers\Controller;
use App\Http\Models\ControlPerceptivo\Factura;
use App\Http\Models\ControlPerceptivo\ControlPerceptivo;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Factura::where('id_status', '=', '1')
            ->get();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Illuminate\Http\Request $request)
    {
        
        $controlPerceptivo = ControlPerceptivo::select('id_control_perceptivo')
            ->where('co_control_perceptivo', '=', $request->get('co_control_perceptivo'))
            ->where('id_status', '=', '1')
            ->first();

        $factura = Factura::firstOrCreate([
            "id_control_perceptivo" => $controlPerceptivo['id_control_perceptivo'],
            "co_factura" => $request->get('co_factura'),
            "co_usuario" => $request->get('co_usuario')
        ]);

        return ['msj' => 'Registro almacenado Correctamente'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Integer id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, \Illuminate\Http\Request $request)
    {

        $factura = Factura::where('id_factura', '=', $id)->first();
       
        $factura->update(
            array(
                "co_factura" => $request->get('co_factura'),
                "co_usuario" => $request->get('co_usuario'),
            )
        );

        return [
            'msj' => 'Registro actualizado correctamente',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $factura = Factura::where('id_factura', '=', $id)->delete();

        return ['msj' => 'Registro borrado correctamente'];
    }
}
