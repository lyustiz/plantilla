<?php

namespace App\Http\Controllers\ControlPerceptivo;

use App\Http\Controllers\Controller;
use App\Http\Models\ControlPerceptivo\Activo;
use App\Http\Models\ControlPerceptivo\ControlPerceptivo;
use App\Http\Models\ControlPerceptivo\Detalle;
use App\Http\Models\ControlPerceptivo\Factura;

class ControlPerceptivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $result = [];

        $controlPerceptivo = json_decode(
            json_encode(
                ControlPerceptivo::with('detalles.activos')
                    ->where('id_status', '=', '1')
                    ->get()
            ), true
        );

        foreach ($controlPerceptivo as $cp) {

            $factura = Factura::where('id_control_perceptivo', '=', $cp['id_control_perceptivo'])->get();

            $facturas = json_decode(
                json_encode(
                    Factura::where('id_control_perceptivo', '=', $cp['id_control_perceptivo'])
                        ->where('id_status', '<=', '2')
                        ->where('id_status', '>', '0')
                        ->get()
                ), true
            );

            $cp = array_merge($cp, ['facturas' => $facturas]);

            array_push($result, $cp);

        }

        return $result;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $resultadoControlPerceptivo = $this->guardarControlperceptivo($request);

        if (isset($resultadoControlPerceptivo['err'])) {
            return $resultadoControlPerceptivo;
        }

        $resultadoFacturas = $this->guardarFacturas($resultadoControlPerceptivo['id'], $request);
        
        if (isset($resultadoFacturas['err'])) {
            return $resultadoFacturas;
        }
        
        $resultadoDetalles = $this->guardarDetalles($resultadoControlPerceptivo['id'], $request);
    
        if (isset($resultadoDetalles['err'])) {
            return $resultadoDetalles;
        }

        $resultadoActivos = $this->guardarActivos($resultadoControlPerceptivo['id'], $resultadoDetalles['id'], $request);

        if (isset($resultadoActivos['err'])) {
            return $resultadoActivos;
        }

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

        $resultadoControlPerceptivo = $this->actualizarControlperceptivo($id, $request);

        if (isset($resultadoControlPerceptivo['err'])) {
            return $resultadoControlPerceptivo;
        }
        
        $resultadoFacturas = $this->actualizarFacturas($id, $request);
        
        if (isset($resultadoFacturas['err'])) {
            return $resultadoFacturas;
        }
        
        $resultadoDetalles = $this->actualizarDetalles($id, $request);
        
        if (isset($resultadoDetalles['err'])) {
            return $resultadoDetalles;
        }
        
        $resultadoActivos = $this->actualizarActivos($id, $resultadoDetalles['id'], $request);
        
        if (isset($resultadoActivos['err'])) {
            return $resultadoActivos;
        }

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
        $detalle = Detalle::where('id_control_perceptivo', '=', $id)->delete();
        $activo = Activo::where('id_control_perceptivo', '=', $id)->delete();
        $factura = Factura::where('id_control_perceptivo', '=', $id)->delete();
        $controlPerceptivo = ControlPerceptivo::where('id_control_perceptivo', '=', $id)->delete();

        return ['msj' => 'Registro borrado correctamente'];
    }

    /**
     * Returns Perceptive Control Details and Assets
     * @param String $numero
     * @return Array
     */
    public function obtenerControlPerceptivo($numero)
    {
        return ControlPerceptivo::select('id_control_perceptivo', 'co_control_perceptivo', 'co_factura')
            ->where('id_status', '=', '1')
            ->where('co_control_perceptivo', '=', $numero)
            ->with('detalles', 'detalles.activos')
            ->get();
    }

    /**
     * Store a newly created ControlPerceptivo and returns the result
     * @param  \Illuminate\Http\Request  $request
     * @return Array
     */
    public function guardarControlPerceptivo(\Illuminate\Http\Request $request)
    {

        try {

            $controlPerceptivo = ControlPerceptivo::firstOrCreate([
                "co_control_perceptivo" => $request->get('co_control_perceptivo'),
                "co_usuario" => $request->get('co_usuario'),
            ]);

            return ['msj' => 'OK', 'id' => $controlPerceptivo['id_control_perceptivo']];

        } catch (\Exception $e) {

            if (strpos($e->getMessage(), 'Unique')) {
                return ['err' => 'Uno de los datos ya se encuentra registrado'];
            } else {
                return ['err' => 'Error desconocido, por favor contacte a soporte tecnico' . $e->getMessage()];
            }

        }
    }

    /**
     * Store newly created Factura and returns the result
     * @param Integer $id
     * @param  \Illuminate\Http\Request  $request
     * @return Array
     */
    public function guardarFacturas($id, \Illuminate\Http\Request $request)
    {

        try {

            $factura = Factura::select('id_factura', 'id_control_perceptivo', 'co_factura')
                                ->where('id_control_perceptivo', '=', $id)
                                ->where('co_factura', '=', $request->get('co_factura'))
                                ->where('id_status', '=', '1')
                                ->first();

            if($factura == null || $factura->exists == false){

                $factura = Factura::create([
                    "id_control_perceptivo" => $id,
                    "id_status" => '1',
                    "co_factura" => $request->get('co_factura'),
                    "co_usuario" => $request->get('co_usuario'),
                ]);
            }


            //FACTURAS ASOCIADAS
            $factura = Factura::where('id_control_perceptivo', '=', $id)->where('id_status', '=', '2')->delete();

            foreach ($request->get('facturas') as $factura) {

                $factura = Factura::create([
                    "id_control_perceptivo" => $id,
                    "id_status" => '2',
                    "co_factura" => $factura['co_factura'],
                    "co_usuario" => $request->get('co_usuario'),
                ]);
            }

            return ['msj' => 'OK'];

        } catch (\Exception $e) {

            if (strpos($e->getMessage(), 'Unique')) {
                return ['err' => 'Una de las facturas ya se encuentra registrada'];
            } else {
                return ['err' => 'Error desconocido, por favor contacte a soporte tecnico'];
            }

        }
    }

    /**
     * Store newly created Detalle and returns the result
     * @param Integer $id
     * @param  \Illuminate\Http\Request  $request
     * @return Array
     */
    public function guardarDetalles($id, \Illuminate\Http\Request $request)
    {
        try {

            $detalle = Detalle::select('co_control_perceptivo')
                ->where('co_control_perceptivo', '=', $request->get('co_control_perceptivo'))
                ->where('tx_tipo_detalle', '=', $request->get('tx_tipo_detalle'))
                ->first();

            if (isset($detalle->exists) && $detalle->exists == true) {
                return ['err' => 'El formulario de ' . $detalle->tx_tipo_detalle . ' ya fue registrado'];
            }

            $detalle = Detalle::create([

                "id_control_perceptivo" => $id,
                "co_control_perceptivo" => $request->get('co_control_perceptivo'),
                "tx_tipo_detalle" => $request->get('tx_tipo_detalle'),
                "tx_tipo_entrega" => (isset($request->get('tx_tipo_entrega')['value'])) ? $request->get('tx_tipo_entrega')['value'] : $request->get('tx_tipo_entrega'),
                "tx_tipo_asignacion" => (isset($request->get('tx_tipo_asignacion')['value'])) ? $request->get('tx_tipo_asignacion')['value'] : $request->get('tx_tipo_asignacion'),
                "mo_orden_compra" => $request->get('mo_orden_compra'),
                "mo_factura" => $request->get('mo_factura'),
                "pc_iva" => $request->get('pc_iva'),
                "co_etiqueta" => $request->get('co_etiqueta'),
                "nb_moneda" => (isset($request->get('nb_moneda')['nb_moneda'])) ? $request->get('nb_moneda')['nb_moneda'] : $request->get('nb_moneda'),
                "co_activo" => $request->get('co_activo'),
                "fe_formulario" => $request->get('fe_formulario'),
                "co_orden_compra" => $request->get('co_orden_compra'),
                "fe_orden_compra" => $request->get('fe_orden_compra'),
                "nb_unidad_solicitante" => $request->get('nb_unidad_solicitante'),
                "nb_responsable_patrimonial_primario" => $request->get('nb_responsable_patrimonial_primario'),
                "nb_responsable_patrimonial_uso" => $request->get('nb_responsable_patrimonial_uso'),
                "nu_cedula_responsable_patrimonial_uso" => $request->get('nu_cedula_responsable_patrimonial_uso'),
                "nb_ubicacion" => $request->get('nb_ubicacion'),
                "co_nota_entrega" => $request->get('co_nota_entrega'),
                "fe_nota_entrega" => $request->get('fe_nota_entrega'),
                "nb_vendedor" => $request->get('nb_vendedor'),
                "fe_factura" => $request->get('fe_factura'),
                "tx_garantia" => $request->get('tx_garantia'),
                "tx_observacion" => $request->get('tx_observacion'),
                "nb_sede" => $request->get('nb_sede'),
                "co_usuario" => $request->get('co_usuario'),

            ]);

            return ['msj' => 'OK', 'id' => $detalle['id_detalle']];

        } catch (\Exception $e) {

            if (strpos($e->getMessage(), 'Unique')) {
                return ['err' => 'Uno de los detalles ya se encuentra registrado'];
            } else {
                return ['err' => 'Error desconocido, por favor contacte a soporte tecnico'];
            }

        }
    }

    /**
     * Store newly created Activo and returns the result
     * @param Integer $idControlPerceptivo
     * @param Integer $idDetalle
     * @param  \Illuminate\Http\Request  $request
     * @return Array
     */
    public function guardarActivos($idControlPerceptivo, $idDetalle, \Illuminate\Http\Request $request)
    {
        try {

            foreach ($request->get('activos') as $asset) {
                $activo = Activo::create([

                    "id_control_perceptivo" => $idControlPerceptivo,
                    "id_detalle" => $idDetalle,
                    "ca_activo" => $asset['ca_activo'],
                    "tx_descripcion" => $asset['tx_descripcion'],
                    "md_activo" => $asset['md_activo'],
                    "tx_color_activo" => $asset['tx_color_activo'],
                    "nb_fabricante" => $asset['nb_fabricante'],
                    "co_modelo" => $asset['co_modelo'],
                    "co_serial" => $asset['co_serial'],
                    "co_etiqueta" => $asset['co_etiqueta'],
                    "nb_moneda" => (isset($request->get('nb_moneda')['nb_moneda'])) ? $request->get('nb_moneda')['nb_moneda'] : $request->get('nb_moneda'),
                    "mo_precio_unitario" => (isset($asset['mo_precio_unitario'])) ? $asset['mo_precio_unitario'] : '',
                    "mo_precio_total" => (isset($asset['mo_precio_total'])) ? $asset['mo_precio_total'] : '',
                    "co_usuario" => $request->get('co_usuario'),

                ]);
            }

            return ['msj' => 'OK'];

        } catch (\Exception $e) {

            if (strpos($e->getMessage(), 'Unique')) {
                return ['err' => 'Uno de los activos ya se encuentra registrado'];
            } else {
                return ['err' => 'Error desconocido, por favor contacte a soporte tecnico'];
            }

        }
    }

    /**
     * Updates a ControlPerceptivo and returns the result
     * @param Integer $id
     * @param  \Illuminate\Http\Request  $request
     * @return Array
     */
    public function actualizarControlPerceptivo($id, \Illuminate\Http\Request $request)
    {

        try {

            $controlPerceptivo = ControlPerceptivo::where('id_control_perceptivo', '=', $id)->first();

            $controlPerceptivo->update(
                array(
                    "co_control_perceptivo" => $request->get('co_control_perceptivo'),
                    "co_usuario" => $request->get('co_usuario'),
                )
            );

            return ['msj' => 'OK'];

        } catch (\Exception $e) {

            if (strpos($e->getMessage(), 'Unique')) {
                return ['err' => 'Uno de los datos ya se encuentra registrado'];
            } else {
                return ['err' => 'Error desconocido, por favor contacte a soporte tecnico'];
            }

        }
    }

    /**
     * Updates Factura and returns the result
     * @param Integer $id
     * @param  \Illuminate\Http\Request  $request
     * @return Array
     */
    public function actualizarFacturas($id, \Illuminate\Http\Request $request)
    {
        try {

            //FACTURAS ASOCIADAS
            $factura = Factura::where('id_control_perceptivo', '=', $id)->delete();

            foreach ($request->get('facturas') as $factura) {
                Factura::create([
                    "id_control_perceptivo" => $id,
                    "co_factura" => $factura['co_factura'],
                    "co_usuario" => $request->get('co_usuario'),
                ]);
            }

            return ['msj' => 'OK'];

        } catch (\Exception $e) {

            if (strpos($e->getMessage(), 'Unique')) {
                return ['err' => 'Uno de las facturas ya se encuentra registrada'];
            } else {
                return ['err' => 'Error desconocido, por favor contacte a soporte tecnico'];
            }

        }
    }

    /**
     * Updates Detalle and returns the result
     * @param Integer $id
     * @param  \Illuminate\Http\Request  $request
     * @return Array
     */
    public function actualizarDetalles($id, \Illuminate\Http\Request $request)
    {
        try {

            $detalle = Detalle::where('id_control_perceptivo', '=', $id)->first();

            $detalle->update(
                array(
                    "id_control_perceptivo" => $id,
                    "co_control_perceptivo" => ($request->get('co_control_perceptivo') != null) ? $request->get('co_control_perceptivo') : ' ',
                    "tx_tipo_entrega" => ($request->get('tx_tipo_entrega') != null) ? $request->get('tx_tipo_entrega') : ' ',
                    "tx_tipo_asignacion" => ($request->get('tx_tipo_asignacion') != null) ? $request->get('tx_tipo_asignacion') : ' ',
                    "mo_orden_compra" => ($request->get('mo_orden_compra') != null) ? $request->get('mo_orden_compra') : ' ',
                    "mo_factura" => ($request->get('mo_factura') != null) ? $request->get('mo_factura') : ' ',
                    "pc_iva" => ($request->get('pc_iva') != null) ? $request->get('pc_iva') : null,
                    "co_etiqueta" => ($request->get('co_etiqueta') != null) ? $request->get('co_etiqueta') : ' ',
                    "nb_moneda" => (isset($request->get('nb_moneda')['nb_moneda'])) ? $request->get('nb_moneda')['nb_moneda'] : $request->get('nb_moneda'),
                    "co_activo" => ($request->get('co_activo') != null) ? $request->get('co_activo') : ' ',
                    "fe_formulario" => ($request->get('fe_formulario') != null) ? $request->get('fe_formulario') : ' ',
                    "co_orden_compra" => ($request->get('co_orden_compra') != null) ? $request->get('co_orden_compra') : ' ',
                    "fe_orden_compra" => ($request->get('fe_orden_compra') != null) ? $request->get('fe_orden_compra') : ' ',
                    "nb_unidad_solicitante" => ($request->get('nb_unidad_solicitante') != null) ? $request->get('nb_unidad_solicitante') : ' ',
                    "nb_responsable_patrimonial_primario" => ($request->get('nb_responsable_patrimonial_primario') != null) ? $request->get('nb_responsable_patrimonial_primario') : ' ',
                    "nb_responsable_patrimonial_uso" => ($request->get('nb_responsable_patrimonial_uso') != null) ? $request->get('nb_responsable_patrimonial_uso') : ' ',
                    "nu_cedula_responsable_patrimonial_uso" => ($request->get('nu_cedula_responsable_patrimonial_uso') != null) ? $request->get('nu_cedula_responsable_patrimonial_uso') : ' ',
                    "nb_ubicacion" => ($request->get('nb_ubicacion') != null) ? $request->get('nb_ubicacion') : ' ',
                    "co_nota_entrega" => ($request->get('co_nota_entrega') != null) ? $request->get('co_nota_entrega') : ' ',
                    "fe_nota_entrega" => ($request->get('fe_nota_entrega') != null) ? $request->get('fe_nota_entrega') : ' ',
                    "nb_vendedor" => ($request->get('nb_vendedor') != null) ? $request->get('nb_vendedor') : ' ',
                    "fe_factura" => ($request->get('fe_factura') != null) ? $request->get('fe_factura') : ' ',
                    "tx_garantia" => ($request->get('tx_garantia') != null) ? $request->get('tx_garantia') : ' ',
                    "tx_observacion" => ($request->get('tx_observacion') != null) ? $request->get('tx_observacion') : ' ',
                    "nb_sede" => ($request->get('nb_sede') != null) ? $request->get('nb_sede') : ' ',
                    "co_usuario" => $request->get('co_usuario'),
                )
            );

            return ['msj' => 'OK', 'id' => $detalle['id_detalle']];

        } catch (\Exception $e) {

            if (strpos($e->getMessage(), 'Unique')) {
                return ['err' => 'Uno de los detalles ya se encuentra registrado'];
            } else {
                return ['err' => 'Error desconocido, por favor contacte a soporte tecnico'];
            }

        }
    }

    /**
     * Updates Activo and returns the result
     * @param Integer $idControlPerceptivo
     * @param Integer $idDetalle
     * @param  \Illuminate\Http\Request  $request
     * @return Array
     */
    public function actualizarActivos($idControlPerceptivo, $idDetalle, \Illuminate\Http\Request $request)
    {
        try {

            $activo = Activo::where('id_control_perceptivo', '=', $idControlPerceptivo)->delete();

            foreach ($request->get('activos') as $asset) {

                Activo::create([

                    "id_control_perceptivo" => $idControlPerceptivo,
                    "id_detalle" => $idDetalle,
                    "ca_activo" => $asset['ca_activo'],
                    "tx_descripcion" => $asset['tx_descripcion'],
                    "md_activo" => $asset['md_activo'],
                    "tx_color_activo" => $asset['tx_color_activo'],
                    "nb_fabricante" => $asset['nb_fabricante'],
                    "co_modelo" => $asset['co_modelo'],
                    "co_serial" => $asset['co_serial'],
                    "co_etiqueta" => $asset['co_etiqueta'],
                    "nb_moneda" => (isset($request->get('nb_moneda')['nb_moneda'])) ? $request->get('nb_moneda')['nb_moneda'] : $request->get('nb_moneda'),
                    "mo_precio_unitario" => (isset($asset['mo_precio_unitario'])) ? $asset['mo_precio_unitario'] : '',
                    "mo_precio_total" => (isset($asset['mo_precio_total'])) ? $asset['mo_precio_total'] : '',
                    "co_usuario" => $request->get('co_usuario'),

                ]);
            }

            return ['msj' => 'OK'];

        } catch (\Exception $e) {

            if (strpos($e->getMessage(), 'Unique')) {
                return ['err' => 'Uno de los activos ya se encuentra registrado'];
            } else {
                return ['err' => 'Error desconocido, por favor contacte a soporte tecnico'];
            }

        }
    }

}
