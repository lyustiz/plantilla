<?php

namespace App\Http\Controllers\ControlPerceptivo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\ControlPerceptivo\ControlPerceptivo;
use App\Http\Models\ControlPerceptivo\Detalle;
use App\Http\Models\ControlPerceptivo\Factura;
use App\Http\Models\General\Moneda;

class ReporteController extends Controller
{

    protected $pdf;

    /**
     * Returns Recepción Pdf
     * @param Request $request
     * @return String
     */
    public function getRecepcionPdf(Request $request)
    {
        $data = $request->input('data');
        $formTitle = $data['item']['titulo'];
        $formName = $data['item']['nombre'];
        
        foreach($data['item']['detalles'] as $detail){
            if($detail['tx_tipo_detalle'] == 'recepcion'){
                $data = $detail;
                $data = array_merge($data, ['titulo' => $formTitle]);
                $data = array_merge($data, ['nombre' => $formName]);
                break;
            } else {
                continue;
            }
        }

        $data['activos'] = $this->getFormattedAssets($data['activos']);
        $data = $this->getConcatenatedInvoices($data);

        $this->pdf = $pdf = app('dompdf.wrapper');
        return base64_encode($pdf->loadView('reports.controlPerceptivo.main', ['data' => $data])->setPaper('letter', 'landscape')->stream());
    }

    /**
     * Returns Control Pdf
     * @param Request $request
     * @return String
     */
    public function getControlPdf(Request $request)
    {
        $data = $request->input('data');
        $formTitle = $data['item']['titulo'];
        $formName = $data['item']['nombre'];

        
        foreach($data['item']['detalles'] as $detail){
            if($detail['tx_tipo_detalle'] == 'control'){
                $data = $detail;
                $data = array_merge($data, ['titulo' => $formTitle]);
                $data = array_merge($data, ['nombre' => $formName]);
                $data = array_merge($data, ['tx_simbolo' => $this->getCurrencySymbol($detail['nb_moneda'])]);
                break;
            } else {
                continue;
            }
        }

        $data['activos'] = $this->getFormattedAssets($data['activos']);
        $data = $this->getConcatenatedInvoices($data);

        $data['invoice_amount'] = floatval($data['mo_factura']);

        $data = array_merge($data, ['mo_iva' => (floatval($data['pc_iva']) / 100) * $data['mo_factura']]);
        $data = array_merge($data, ['mo_sub_total' => ($data['mo_factura'] - $data['mo_iva'])]);
        $data = array_merge($data, ['mo_total' => $data['mo_factura']]);
        
        $this->pdf = $pdf = app('dompdf.wrapper');
        return base64_encode($pdf->loadView('reports.controlPerceptivo.main', ['data' => $data])->setPaper('letter', 'landscape')->stream());
    }

    /**
     * Returns Asignacion Pdf
     * @param Request $request
     * @return String
     */
    public function getAsignacionPdf(Request $request)
    {
        $data = $request->input('data');
        $formTitle = $data['item']['titulo'];
        $formName = $data['item']['nombre'];
        
        foreach($data['item']['detalles'] as $detail){
            if($detail['tx_tipo_detalle'] == 'asignacion'){
                $data = $detail;
                $data = array_merge($data, ['titulo' => $formTitle]);
                $data = array_merge($data, ['nombre' => $formName]);
                break;
            } else {
                continue;
            }
        }

        $data['tx_tipo_asignacion'] = ucfirst(strtolower($data['tx_tipo_asignacion']));
        $data['activos'] = $this->getFormattedAssets($data['activos']);
        $data = $this->getConcatenatedInvoices($data);
        
        if($data['tx_observacion'] == 'N/A'){
            $data['tx_observacion'] = 'Todo funcionario de Bandes debe vigilar, conservar y salvaguardar los documentos y bienes de la Administración Pública confiados a su guarda , uso o administración,según lo estblecido en la Ley del Estatuto de la Función Pública (Art. 33 Numeral 7).';
        }
            
        $this->pdf = $pdf = app('dompdf.wrapper');
        return base64_encode($pdf->loadView('reports.controlPerceptivo.main', ['data' => $data])->setPaper('letter', 'landscape')->stream());
    }

    /**
     * Returns formated activos
     * @param Array $activos
     * @return Array
     */
    public function getFormattedAssets($activos) {

        if (count($activos) < 6) {
            $counter = 6 - count($activos);

            for ($i = 0; $i < $counter; $i++) {
                array_push($activos, [
                    "ca_activo" => "",
                    "tx_descripcion" => "",
                    "md_activo" => "",
                    "tx_color_activo" => "",
                    "nb_fabricante" => "",
                    "co_modelo" => "",
                    "co_serial" => "",
                    "co_etiqueta" => "",
                    "mo_precio_unitario" => "",
                    "mo_precio_total" => "",
                ]);
            }
        }

        return $activos;
    }

    /**
     * Returns Control Details and Assets
     * @param Request $request
     * @return Array
     */
    public function getPerceptiveControl($id)
    {
        return Detalle::where('id_status', '=', '1')
            ->where('id_control_perceptivo', '=', $id)
            ->with('activos')
            ->get();
    }

    /**
     * Returns currency symbol by currency name
     * @param String $name
     * @return String
     */
    public function getCurrencySymbol($name){
        return Moneda::select('tx_simbolo')
            ->where('nb_moneda', '=', $name)
            ->first()['tx_simbolo'];
    }

    /**
     * Returns concatenated invoices
     * @param Array $data
     * @return Array
     */
    public function getConcatenatedInvoices($data){

        $codigosFactura = '';
        $controlPerceptivo = ControlPerceptivo::select('id_control_perceptivo')->where('co_control_perceptivo', '=', $data['co_control_perceptivo'])->first();

        if(isset($controlPerceptivo) && $controlPerceptivo->exists == true){

            $facturas = Factura::select('co_factura')->where('id_control_perceptivo', '=', $controlPerceptivo['id_control_perceptivo'])->get();
            
            if(isset($facturas) && count($facturas) > 0){

                foreach($facturas as $factura){
                    $codigosFactura .= ' ' . $factura['co_factura'];
                }

                $data = array_merge($data, ['co_factura' => $codigosFactura]);

                return $data;

            } 
        
        }

        return $data;
    }
}

