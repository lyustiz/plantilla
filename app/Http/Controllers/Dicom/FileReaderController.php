<?php

namespace App\Http\Controllers\Dicom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Http\Models\Dicom\Solicitud;
use App\Http\Models\Dicom\DetSolicitud;
use App\Http\Models\Dicom\Transferencia;
use App\Http\Models\Dicom\DetTransferencia;
use App\Http\Models\Dicom\Ordenacion;
use App\Http\Models\Dicom\DetOrdenacion;

use App\Http\Models\General\Operacion;
class FileReaderController extends Controller
{
    protected $root;
    protected $directory;

    protected $id_usuario;
    protected $id_status;
    protected $id_subasta;
    protected $fileCod;
    

    public function index($id, $cod, $num, $user)
    {
        $this->root = Storage_path('app/');
        $this->directory = 'public/Dicom';

        $this->id_usuario = $user;
        $this->id_status = 5;
        $this->id_subasta = $id;
        $this->fileCod = $cod;

        $allowedFiles = array($num);
        
        $processed=[];

        foreach(Storage::allFiles($this->directory) as $path) {
            $filePath = pathinfo($this->root.$path);
            $filenamePart = explode("_", $filePath['filename']);
            $fileNameNum = $filenamePart[1];
            // echo $filenamePart[0]. "<br />\n";
            // echo $filePath['filename']. "<br />\n";
            // echo $filePath['extension']. "<br />\n";
            // echo $filePath['dirname']. "<br />\n";
            if($filenamePart[0]== $this->fileCod && in_array($fileNameNum, $allowedFiles))
            {
                // echo "Archivo: " . $filePath['filename'].".".$filePath['extension']. "<br />\n";

                $details = array();
                foreach (file($this->root.$path) as $key => $line) {
                    // echo "Línea #<b>{$key}</b> : " . htmlspecialchars($line) . "<br />\n";
                    $type = ($key == 0) ? 'ENC' : $key;
                    $details[(string)$type] = $this->getFields($line, $type,$fileNameNum);
                }

                $header = array_shift($details); 
                $header['fileNameCurrencyCode'] = $filenamePart[3]. '_' .$fileNameNum;
                $header['lines'] = $details;
                array_push($processed,$header);
            }
        }
        // dd($processed);
        $headers= $this->getHeaders($num);

        return [
            'files' => $processed,
            'headers' => $headers['headers'],
            'headersListDet' => $headers['headersDet'],
        ];
    }

    function getHeaders($fileNum)
    {
        $headers=[];
        switch ($fileNum) 
        {
            case 1;
                $headers['headers']=array(
                    array('text' => 'Codigo Subasta','value' => 'cod_subasta'),
                    array('text' => 'Fecha Subasta', 'value' => 'fe_subasta'),
                    array('text' => 'Cantidad de Postura', 'value' => 'nu_postura'),
                    array('text' => 'Divisas Demanda', 'value' => 'nu_div_demanda'),
                    array('text' => 'Cantidad Ofertas', 'value' => 'nu_ofertas'),
                    array('text' => 'Divisas Ofertas', 'value' => 'nu_div_oferta'),
                    array('text' => 'Bolivares Ofertas', 'value' => 'nu_bs_oferta'),
                    array('text' => 'Moneda', 'value' => 'id_moneda')
                );
                $headers['headersDet']=array(
                    array('text' => 'N° Solicitud','value' => 'nu_solicitud'),
                    array('text' => 'Operación', 'value' => 'id_operacion'),
                    array('text' => 'Cliente', 'value' => 'tx_rif'),
                    array('text' => 'N° Cuenta Bs', 'value' => 'tx_cta_bsf'),
                    array('text' => 'N° Cuenta Div', 'value' => 'tx_cta_div'),
                    array('text' => 'Monto Bs', 'value' => 'nu_monto_bsf'),
                    array('text' => 'Monto Divisa', 'value' => 'nu_monto_div'),
                    array('text' => 'Fecha Operación', 'value' => 'fe_operacion'),
                    array('text' => 'Fecha Valor', 'value' => 'fe_valor'),
                );

            break;

            case 3:
                $headers['headers']=array(
                    array('text' => 'Codigo Subasta','value' => 'cod_subasta'),
                    array('text' => 'Fecha Subasta', 'value' => 'fe_subasta'),
                    array('text' => 'Bs a Enviar', 'value' => 'nu_bsf_enviar'),
                    array('text' => 'Bs a Recibir', 'value' => 'nu_bsf_recibir'),
                    array('text' => 'Divisas a Enviar', 'value' => 'nu_div_enviar'),
                    array('text' => 'Divisas a Recibir', 'value' => 'nu_div_recibir'),
                    array('text' => 'Moneda', 'value' => 'id_moneda') 
                );
                $headers['headersDet']=array(
                    array('text' => 'Banco','value' => 'id_banco'),
                    array('text' => 'Bs a Enviar', 'value' => 'nu_bsf_enviar'),
                    array('text' => 'Bs a Recibir', 'value' => 'nu_bsf_recibir'),
                    array('text' => 'Divisas a Enviar', 'value' => 'nu_div_enviar'),
                    array('text' => 'Divisas a Recibir', 'value' => 'nu_div_recibir'),
                    array('text' => 'Fecha Operación', 'value' => 'fe_operacion'),
                    array('text' => 'Fecha Valor', 'value' => 'fe_valor'),
                );
            break;

            case 4:
                $headers['headers']=array(
                    array('text' => 'Codigo Subasta','value' => 'cod_subasta'),
                    array('text' => 'Fecha Subasta', 'value' => 'fe_subasta'),
                    array('text' => 'Cantidad Operaciones', 'value' => 'nu_operacion'),
                    array('text' => 'Bs a Desbloquear', 'value' => 'nu_bsf_desbloquear'),
                    array('text' => 'Divisa a Desbloquear', 'value' => 'nu_div_desbloquear'),
                    array('text' => 'Bs a Acreditar', 'value' => 'nu_bsf_acreditar'),
                    array('text' => 'Divisa a Acreditar', 'value' => 'nu_div_acreditar'),
                    array('text' => 'Bs a debitar', 'value' => 'nu_bsf_debitar'),
                    array('text' => 'Divisas a debitar', 'value' => 'nu_div_debitar'),
                    array('text' => 'Moneda', 'value' => 'id_moneda') 
                );
                $headers['headersDet']=array(
                    array('text' => 'N° Solicitud','value' => 'nu_solicitud'),
                    array('text' => 'Bs a Desbloqueo','value' => 'nu_bsf_desbloqueo'),
                    array('text' => 'Divisas Desbloqueo','value' => 'nu_div_desbloqueo'),
                    array('text' => 'Bs a Acreditar','value' => 'nu_bsf_acreditar'),
                    array('text' => 'Divisas a Acreditar','value' => 'nu_div_acreditar'),
                    array('text' => 'Bs a Debitar','value' => 'nu_bsf_debitar'),
                    array('text' => 'Divisas Debitar','value' => 'nu_div_debitar'),
                    array('text' => 'Fecha de operación', 'value' => 'fe_operacion'),
                    array('text' => 'Fecha de Valor', 'value' => 'fe_valor'),
                );
            break;
                $headers['headers']=array(
                );
                $headers['headersDet']=array(
                );
            default:
        }
        return $headers;
    }

    public function getFields($line, $type,$fileNameNum)
    {
        $header = [];
        $detail = [];

        switch ($fileNameNum) 
        {
            case 1;
                $header = [
                    'cod_subasta'       => ['pos' => 4,  'type' =>'tx'],
                    'fe_subasta'        => ['pos' => 8,  'type' =>'fe'],
                    'nu_postura'        => ['pos' => 7,  'type' =>'nup'],
                    'nu_div_demanda'    => ['pos' => 16, 'type' =>'nu'],
                    'nu_bsf_demanda'    => ['pos' => 16, 'type' =>'nu'],
                    'nu_ofertas'        => ['pos' => 7,  'type' =>'nup'],
                    'nu_div_oferta'     => ['pos' => 16, 'type' =>'nu'],
                    'nu_bs_oferta'      => ['pos' => 16, 'type' =>'nu'],
                    'id_moneda'         => ['pos' => 4,  'type' =>'tx'],

                ];

                $detail = [
                    'nu_solicitud'  => ['pos' => 12, 'type' => 'tx'],
                    'id_operacion'  => ['pos' => 1, 'type'  => 'id'],
                    'tx_rif'        => ['pos' => 10, 'type' => 'tx'],
                    'tx_cta_bsf'    => ['pos' => 20, 'type' => 'tx'],
                    'tx_cta_div'    => ['pos' => 20, 'type' => 'tx'],
                    'nu_monto_bsf'  => ['pos' => 16, 'type' => 'nu'],
                    'nu_monto_div'  => ['pos' => 16, 'type' => 'nu'],
                    'fe_operacion'  => ['pos' => 8, 'type'  => 'fe'],
                    'fe_valor'      => ['pos' => 8, 'type'  => 'fe']
                ];
                break;

            case 3:

                $header = [
                    'cod_subasta'       => ['pos' =>  4,  'type' => 'tx'],
                    'fe_subasta'        => ['pos' =>  8,  'type' => 'fe'],
                    'nu_bsf_enviar'     => ['pos' => 16,  'type' => 'nu'],
                    'nu_bsf_recibir'    => ['pos' => 16,  'type' => 'nu'],
                    'nu_div_enviar'     => ['pos' => 16,  'type' => 'nu'],
                    'nu_div_recibir'    => ['pos' => 16,  'type' => 'nu'],
                    'id_moneda'         => ['pos' => 4 ,  'type' => 'tx']
                ];

                $detail = [
                    'id_banco'          => ['pos' =>  4, 'type' => 'tx'],
                    'nu_bsf_enviar'     => ['pos' => 16, 'type' => 'nu'],
                    'nu_bsf_recibir'    => ['pos' => 16, 'type' => 'nu'],
                    'nu_div_enviar'     => ['pos' => 16, 'type' => 'nu'],
                    'nu_div_recibir'    => ['pos' => 16, 'type' => 'nu'],
                    'fe_operacion'      => ['pos' =>  8, 'type' => 'fe'],
                    'fe_valor'          => ['pos' =>  8, 'type' => 'fe']
                ];
            break;

            case 4:
                $header = [
                    'cod_subasta'           => ['pos' => 4,  'type' => 'tx'],
                    'fe_subasta'            => ['pos' => 8,  'type' => 'fe'],
                    'nu_operacion'          => ['pos' => 7,  'type' => 'nup'],
                    'nu_bsf_desbloquear'    => ['pos' => 16, 'type' => 'nu'],
                    'nu_div_desbloquear'    => ['pos' => 16, 'type' => 'nu'],
                    'nu_bsf_acreditar'      => ['pos' => 16, 'type' => 'nu'],
                    'nu_div_acreditar'      => ['pos' => 16, 'type' => 'nu'],
                    'nu_bsf_debitar'        => ['pos' => 16, 'type' => 'nu'],
                    'nu_div_debitar'        => ['pos' => 16, 'type' => 'nu'],
                    'id_moneda'             => ['pos' => 4,  'type' => 'tx']
                ];

                $detail = [
                    'nu_solicitud'      => ['pos' => 12, 'type' => 'tx'],
                    'nu_bsf_desbloqueo' => ['pos' => 16, 'type' => 'nu'],
                    'nu_div_desbloqueo' => ['pos' => 16, 'type' => 'nu'],
                    'nu_bsf_acreditar'  => ['pos' => 16, 'type' => 'nu'],
                    'nu_div_acreditar'  => ['pos' => 16, 'type' => 'nu'],
                    'nu_bsf_debitar'    => ['pos' => 16, 'type' => 'nu'],
                    'nu_div_debitar'    => ['pos' => 16, 'type' => 'nu'],
                    'fe_operacion'      => ['pos' => 8,  'type' => 'fe'],
                    'fe_valor'          => ['pos' => 8,  'type' => 'fe']
                ];
                break;

            default:
                return 'Error!!!';
        }
        
        $data = [];
        $index = 0;
        $field = ($type == 'ENC') ? $header : $detail;

        foreach ($field as $key => $value) 
        {
            $data[$key] = substr($line, $index, $value['pos']);
            $data[$key] = $this->getFormat($data[$key], $value['type']);
            $index += $value['pos'];
        }

        // unset($data['cod_subasta']);
        return $data;
    }

    function getFormat($data, $type)
    {
        
        switch ($type) 
        {
            case 'nup';
                settype($data,'integer');
                return $data;
                break;

            case 'nu':
                $decimals   = '2';
                $total      = strlen($data) ;
                $length     = $total-$decimals;
                $data       = substr($data, 0, $length).'.'.substr($data, -2, $decimals);
                settype($data, 'float');
                $data = number_format($data, 2, '.', '');
                return $data;
            break;

            case('fe'):
                $data = substr($data, 0, 2) . '-' . substr($data, 2, 2) . '-' . substr($data, 4, 4);
                return Carbon::parse($data)->Format('d-m-Y');
                break;

                case('id'):
                $op = Operacion::where('co_operacion', $data)->first();
                return $op->id_operacion;

                break;
            default:
                return $data;
        }
    }

    public function storeFile($header,$details,$fileNameNum)
    {
        // dd($header,$details,$fileNameNum);
        unset($header['cod_subasta']);
        $header = array_merge($header,[
            'id_usuario'    => $this->id_usuario,
            'id_status'     => $this->id_status,
            'id_subasta'    => $this->id_subasta,
        ]);
        $stored='false';
        switch ($fileNameNum) 
        {
            case 1:
                $counter=Solicitud::where('id_subasta',$this->id_subasta)
                                    ->where('id_moneda',$header['id_moneda'])
                                    ->count();
                if($counter == 0){
                    $solicitud = Solicitud::create($header);
    
                    foreach ($details as $key => $value) {
                        $value = array_merge($value,[
                            'id_usuario'    => $this->id_usuario,
                            'id_status'     => $this->id_status,
                            'id_solicitud'  => $solicitud->id_solicitud,
                            'fe_creado'     => Carbon::now(),
                        ]);
                        $details[$key] = $value;
                    }
    
                    $detSolicitud = DetSolicitud::insert($details);
                    $stored='true';
                }else{
                    $stored = 'duplicate';
                }
            break;

            case 3:
                $counter=Transferencia::where('id_subasta',$this->id_subasta)
                                    ->where('id_moneda',$header['id_moneda'])
                                    ->count();
                if($counter == 0){
                    $transferencia = Transferencia::create($header);
        
                    foreach ($details as $key => $value) {
                        $value = array_merge($value,[
                            'id_usuario'    => $this->id_usuario,
                            'id_transferencia'  => $transferencia->id_transferencia,
                            'fe_creado'     => Carbon::now(),
                        ]);
                        $details[$key] = $value;
                    }
        
                    $detTransferencia = DetTransferencia::insert($details);
                    $stored='true';
                }else{
                    $stored = 'duplicate';
                }

            break;

            case 4:
                $counter=Ordenacion::where('id_subasta',$this->id_subasta)
                                    ->where('id_moneda',$header['id_moneda'])
                                    ->count();
                                    
                if($counter == 0){
                    $ordenacion = Ordenacion::create($header);
                    
                    $latest = DetOrdenacion::orderBy('fe_creado','desc')
                                            ->orderBy('id_det_ordenacion','desc')
                                            ->first();
                    
                    if($latest === NULL){
                        $latest = 0;
                    }else{
                        $latest = (int)$latest->nu_abono;
                    }
                    foreach ($details as $key => $value) {
                        $latest += 1 ;
                        $value = array_merge($value,[
                            'id_usuario'    => $this->id_usuario,
                            'id_ordenacion'  => $ordenacion->id_ordenacion,
                            'nu_abono'  => $latest,
                            'nu_debito'  => $latest,
                            'fe_creado'     => Carbon::now(),
                        ]);
                        $details[$key] = $value;
                    }
                    
                    $detOrdenacion = DetOrdenacion::insert($details);
                    $stored='true';
                }else{
                    $stored = 'duplicate';
                }

            break;

            default:
                $stored = 'false';
        }   
        
        return $stored;
    }


    public function store($id, $cod, $num, $user)
    {
        
        $stored = array();
        $files = $this->index($id, $cod, $num, $user);
        $files = $files['files'];

        foreach ($files as $key => $file) {
            $details = $file['lines'];
            $fileNameNum = $num;
            unset($file['lines']);
            unset($file['fileNameCurrencyCode']);
            $header = $file;

            array_push(
                $stored,
                $this->storeFile($header,$details,$fileNameNum)
            );
        }

        $value = true;
        $msj = 'Guardados correctamente';
        if(in_array('false', $stored))
        {
            $value = false;
            $msj = 'Error al guardar';
        }        
        return [
            'stored' => $value,
            'msj' => $msj,
        ];
    }
}