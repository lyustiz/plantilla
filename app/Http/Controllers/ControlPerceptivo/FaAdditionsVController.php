<?php

namespace App\Http\Controllers\ControlPerceptivo;

use App\Http\Controllers\Controller;
use App\Http\Models\ControlPerceptivo\ControlPerceptivo;
use App\Http\Models\ControlPerceptivo\Factura;
use App\Http\Models\ControlPerceptivo\Activo;
use App\Http\Models\ControlPerceptivo\Detalle;
use Illuminate\Support\Facades\DB;

class FaAdditionsVController extends Controller
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
     * Returns Mass adicion by Invoice number
     * @param String $num
     * @return Array
     */
    public function getAdditionByInvoiceNumber($num)
    {
        $adicion = array();

        $adicion =
            ['adicion' =>
            DB::connection('oracle')
                ->table('FA_ADDITIONS_V')
                ->leftJoin(
                    'FA_ASSET_DISTRIBUTION_V',
                    'FA_ASSET_DISTRIBUTION_V.ASSET_NUMBER', '=', 'FA_ADDITIONS_V.ASSET_NUMBER'
                )
                ->leftJoin(
                    'PER_PEOPLE_X',
                    'PER_PEOPLE_X.EMPLOYEE_NUMBER', '=', 'FA_ASSET_DISTRIBUTION_V.EMPLOYEE_NUMBER'
                )
                ->leftJoin(
                    'FA_ASSET_INVOICES_V',
                    'FA_ASSET_INVOICES_V.ASSET_NUMBER', '=', 'FA_ADDITIONS_V.ASSET_NUMBER'
                )
                ->leftJoin(
                    'FA_INVOICE_DETAILS_V',
                    'FA_INVOICE_DETAILS_V.INVOICE_ID', '=', 'FA_ASSET_INVOICES_V.INVOICE_ID'
                )
                ->select(
                    'FA_ADDITIONS_V.ASSET_NUMBER as co_activo',
                    'FA_ADDITIONS_V.TAG_NUMBER as co_etiqueta',
                    'FA_ASSET_DISTRIBUTION_V.EMPLOYEE_NUMBER',
                    'FA_ASSET_DISTRIBUTION_V.EMPLOYEE_NAME as nb_res_pat_pri',
                    'PER_PEOPLE_X.ATTRIBUTE2 as nb_unidad_solicitante',
                    'FA_ASSET_INVOICES_V.INVOICE_ID',
                    'FA_ASSET_INVOICES_V.INVOICE_NUMBER as co_factura',
                    'FA_ASSET_INVOICES_V.PO_NUMBER as co_orden_compra',
                    'FA_ASSET_INVOICES_V.INVOICE_COST as mo_factura',
                    'FA_INVOICE_DETAILS_V.INVOICE_DATE as fe_factura',
                    'FA_INVOICE_DETAILS_V.VENDOR_NUMBER as nu_vendedor',
                    'FA_INVOICE_DETAILS_V.VENDOR_NAME as nb_vendedor'
                )
                ->where(
                    'FA_ASSET_INVOICES_V.INVOICE_NUMBER', '=', $num
                )
                ->first(),
        ];

        if (!isset($adicion['adicion'])) {
            $adicion = $this->getPerceptiveControlConcatenation(['adicion' => []], $num);
            $adicion = $this->getAssetsByPerceptiveControl($adicion);
            return $adicion;
        }

        $adicion['adicion'] = array_change_key_case(json_decode(json_encode($adicion['adicion']), true), CASE_LOWER);

        $date = new \DateTime($adicion['adicion']['fe_factura']);
        $adicion['adicion']['fe_factura'] = $date->format('Y-m-d');

        $adicion = $this->getAssetsByInvoiceNumber($adicion);

        $adicion = $this->getPerceptiveControlConcatenation($adicion, $num);

        return $this->getRelatedInvoices($adicion);
    }

    /**
     * Returns activos by activo number
     * @return Array
     */
    public function getAssetsByInvoiceNumber($adicion)
    {

        $activos = array();
        $newAssets = ["activos" => []];
        if (isset($adicion['adicion']['co_factura']) && $adicion['adicion']['co_factura'] != '') {
            $activos =
            DB::connection('oracle')
                ->table('FA_ASSET_INVOICES_V')
                ->select(
                    'DESCRIPTION as tx_descripcion',
                    'MANUFACTURER_NAME as nb_fabricante',
                    'MODEL_NUMBER as co_modelo',
                    'SERIAL_NUMBER as co_serial',
                    'TAG_NUMBER as co_etiqueta'
                )
                ->where(
                    'INVOICE_NUMBER', 'like', '%' . $adicion['adicion']['co_factura'] . '%'
                )
                ->get()
                ->toArray();

            $activos = json_decode(json_encode($activos), true);

        } else {

            $asset_number = str_replace('VES_', '', $adicion['adicion']['co_activo']);

            $activos =
            DB::connection('oracle')
                ->table('FA_ASSET_INVOICES_V')
                ->leftJoin(
                    'FA_ASSET_INVOICES_V ainv',
                    'FA_ASSET_INVOICES_V.INVOICE_NUMBER', '=', 'ainv.INVOICE_NUMBER'
                )
                ->select(
                    'ainv.INVOICE_NUMBER as co_factura',
                    'ainv.DESCRIPTION as tx_descripcion',
                    'ainv.MANUFACTURER_NAME as nb_fabricante',
                    'ainv.MODEL_NUMBER as co_modelo',
                    'ainv.SERIAL_NUMBER as co_serial',
                    'ainv.TAG_NUMBER as co_etiqueta',
                    'ainv.VENDOR_NUMBER as nu_vendedor',
                    'ainv.VENDOR_NAME as nb_vendedor'
                )
                ->where(
                    'FA_ASSET_INVOICES_V.ASSET_NUMBER', 'like', '%' . $asset_number . '%'
                )
                ->get()
                ->toArray();

            $activos = json_decode(json_encode($activos), true);

            if ($activos != null && count($activos) > 1) {

                $adicion['adicion']['co_factura'] = $activos[0]['co_factura'];
                $adicion['adicion']['nb_vendedor'] = $activos[0]['nb_vendedor'];
                $adicion['adicion']['nu_vendedor'] = $activos[0]['nu_vendedor'];

            } else {



            }

        }

        foreach ($activos as $activo) {
            $activo = array_change_key_case($activo, CASE_LOWER);
            $activo = array_merge($activo, [
                'ca_activo' => '1',
                'md_activo' => 'N/A',
                'tx_color_activo' => 'N/A',
                'mo_precio_unitario' => '*REQUERIDO',
                'mo_precio_total' => '*REQUERIDO',
            ]);
            if (!in_array($activo['co_etiqueta'], $newAssets['activos'])) {
                array_push($newAssets['activos'], $activo);
            }
        }

        $newAssets['activos'] = $this->getMergedAssets($newAssets['activos']);

        return array_merge($adicion, $newAssets);
    }

    /**
     * Returns merged activos
     * @param Array
     * @return Array
     */
    public function getMergedAssets($activos)
    {

        $orderedAssets = [];

        foreach ($activos as $assetToCompare) {

            $counter = 0;
            $serials = '';
            $tags = '';

            foreach ($activos as $activo) {
                if (
                    strpos($assetToCompare['tx_descripcion'], $activo['tx_descripcion']) !== false &&
                    strpos($assetToCompare['tx_color_activo'], $activo['tx_color_activo']) !== false &&
                    strpos($assetToCompare['md_activo'], $activo['md_activo']) !== false &&
                    strpos($assetToCompare['nb_fabricante'], $activo['nb_fabricante']) !== false &&
                    strpos($assetToCompare['co_modelo'], $activo['co_modelo']) !== false
                ) {

                    $counter++;
                    if (strpos($activo['co_serial'], 'N/A') === false) {
                        $serials .= ' ' . $activo['co_serial'];
                    }
                    if (strpos($activo['co_etiqueta'], 'N/A') === false) {
                        $tags .= ' ' . $activo['co_etiqueta'];
                    }

                } else {
                    continue;
                }
            }

            $assetToCompare['ca_activo'] = ($counter > 0) ? $counter : 1;
            $assetToCompare['co_serial'] = ($serials != '') ? $serials : 'N/A';
            $assetToCompare['co_etiqueta'] = ($tags != '') ? $tags : 'N/A';

            if (!in_array($assetToCompare, $orderedAssets)) {
                array_push($orderedAssets, $assetToCompare);
            }
        }

        return $orderedAssets;
    }

    /**
     * Returns array with perceptive control concatenated
     * @return Array
     */
    public function getPerceptiveControlConcatenation($adicion, $num)
    {

        $factura = json_decode(
            json_encode(
                Factura::select('id_control_perceptivo')
                    ->where('co_factura', 'like', '%' . $num . '%')
                    ->where('id_status', '=', '1')
                    ->first()
            ), true
        );

        if ($factura != null) {

            $perceptiveControl = json_decode(
                json_encode(
                    ControlPerceptivo::select('co_control_perceptivo')
                        ->where('id_control_perceptivo', '=', $factura['id_control_perceptivo'])
                        ->orderBy('id_control_perceptivo', 'desc')
                        ->first()
                ), true
            );

        } else {

            $perceptiveControl = json_decode(
                json_encode(
                    ControlPerceptivo::select('co_control_perceptivo')
                        ->orderBy('id_control_perceptivo', 'desc')
                        ->first()
                ), true
            );

            if ($perceptiveControl != null) {
                $perceptiveControlValues = explode("-", $perceptiveControl['co_control_perceptivo']);
            } else {
                $perceptiveControlValues = [date("Y"), "0"];
            }

            $perceptiveControl["co_control_perceptivo"] =
            ($perceptiveControlValues[0] != date("Y")) ? date("Y") . "-" . "1" : $perceptiveControlValues[0] . "-" . (intval($perceptiveControlValues[1]) + 1);
        }

        if ($adicion && count($adicion["adicion"]) > 0) {

            return array_merge($adicion, array_merge($perceptiveControl, ['fe_formulario' => date("Y-m-d")]));

        } else {

            return array_merge($perceptiveControl, ['fe_formulario' => date("Y-m-d")]);

        }
    }

    /**
     * Returns Array with related invoices
     * @param Array
     * @return Array
     */
    public function getRelatedInvoices($adicion)
    {

        $controlPerceptivo = ControlPerceptivo::select('id_control_perceptivo')->where('co_control_perceptivo', '=', $adicion['co_control_perceptivo'])->first();

        if (isset($controlPerceptivo) && $controlPerceptivo->exists == true) {

            $facturas = Factura::select('co_factura', 'id_status')->where('id_control_perceptivo', '=', $controlPerceptivo['id_control_perceptivo'])->get();
            return array_merge($adicion, ['facturas' => json_decode(json_encode($facturas), true)]);

        }

        return array_merge($adicion, ['facturas' => []]);

    }

    /**
     * Returns assets by perceptive control
     * @param Array $addition
     * @return Array
     */
    public function getAssetsByPerceptiveControl($adicion){

        $idControlPerceptivo = ControlPerceptivo::select('id_control_perceptivo')->where('co_control_perceptivo', '=', $adicion['co_control_perceptivo'])->first()['id_control_perceptivo'];
        $detalles = Detalle::select('id_detalle','tx_tipo_detalle')->where('id_control_perceptivo', '=', $idControlPerceptivo)->get();
        $activos = Activo::where('id_control_perceptivo', '=', $idControlPerceptivo)->get();

        foreach($activos as $activo){

            foreach($detalles as $detalle){

                if($activo['id_detalle'] == $detalle['id_detalle']){
                    $activo['tx_tipo_detalle'] = $detalle['tx_tipo_detalle'];
                }
            }
        }

        return array_merge($adicion, ['activos' => $activos]);

    }

}
