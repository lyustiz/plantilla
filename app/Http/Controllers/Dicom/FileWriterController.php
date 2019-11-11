<?php

namespace App\Http\Controllers\Dicom;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Http\Models\Dicom\Solicitud;
use App\Http\Models\Dicom\DetSolicitud;
use App\Http\Models\Dicom\Ordenacion;
use App\Http\Models\Dicom\DetOrdenacion;
use App\Http\Models\Dicom\Subasta;

use App\Http\Models\General\Operacion;

use App\Http\Utils\ServiceHandler;

class FileWriterController extends Controller
{
    protected $root;
    protected $directory;
    protected $bankCode;
    protected $id_subasta;
    protected $co_subasta;
    protected $fileNumber;
    protected $serviceHandler;
    
    /**
     * FileWriterController index
     */
    public function index($id, $cod, $file)
    {
        $this->root      = Storage_path('app/');
        $this->directory      = 'public/Dicom';
        $this->bankCode       = env('BANDES_BCV_COD', '0152');
        $this->id_subasta      = $id;
        $this->co_subasta    = $cod;
        $this->fileNumber     = $file;
        // $this->serviceHandler = ServiceHandler::Instance();

        return $this->writeFiles();
    }

    /**
     * Writes files 2(comprobacion) and 5(operaciones) on storage and uploads them to BCV
     * @return Array Resultado de la operacion
     */
    public function writeFiles()
    {
        try
        {
            $results = array();

            if($this->fileNumber == '2')
            {
                $solicitudes = Solicitud:: where('id_subasta',$this->id_subasta)
                                            ->get();
                
                foreach($solicitudes as $solicitud)
                {
                    $detallesSolicitud = DetSolicitud::with('status:id_status,nb_status,nb_status2')
                                                        ->where('id_solicitud',$solicitud->id_solicitud)
                                                        ->get();                    
                    $lines  = array();
                    foreach($detallesSolicitud as $detalleSolicitud)
                    {
                        $status = $detalleSolicitud->status->nb_status2;
                        $nu_solicitud = $detalleSolicitud->nu_solicitud;
                        $line  = $nu_solicitud . $status ."\n";
                        array_push($lines, $line);
                    }
                    array_push($results, $this->writer($solicitud->id_moneda,$lines));
                }
            }
            else if($this->fileNumber == '5')
            {
                $ordenaciones = Ordenacion::where('id_subasta', $this->id_subasta)
                                            ->get();

                foreach($ordenaciones as $ordenacion)
                {
                    $detallesOrdenacion = DetOrdenacion::where('id_ordenacion',$ordenacion->id_ordenacion)
                                                        ->get();

                    $lines = array();
                    foreach ($detallesOrdenacion as $detalleOrdenacion) 
                    {
                        $requestNumber = $detalleOrdenacion['nu_solicitud'];
                        $creditNumber  = str_pad($detalleOrdenacion['nu_abono'],10,"0",STR_PAD_LEFT);
                        $debitNumber   = str_pad($detalleOrdenacion['nu_debito'],10,"0",STR_PAD_LEFT);
                        $line = $requestNumber.$creditNumber.$debitNumber."\n";
                        array_push($lines, $line);
                    }

                    array_push($results, $this->writer($ordenacion->id_moneda,$lines));
                }
            } 

            // VERIFICO EL RESULTADO DE LAS OPERACIONES
            $msj = 'No se pudieron generar o enviar todos los archivos, por favor intente nuevamente.';
            $writed = false;
            if(in_array('true', $results))
            {
                if($this->fileNumber == '5'){
                    //FINALIZO LA SUBASTA
                    $subasta = Subasta::find($this->id_subasta);
                    $subasta->id_status = 17;
                    $subasta->fe_cierre = Carbon::now();
                    $subasta->save();
                }
                $msj = 'Archivos creados y enviados correctamente.';
                $writed = true;
            }
            return [
                'writed' => $writed,
                'msj' => $msj
            ];

        }
        catch(\Exception $e)
        {
            $msj = 'No se pudieron generar o enviar todos los archivos, por favor intente nuevamente.';
            return [
                'result' => false, 
                'msj' => $msj
            ];
        }
    }

    public function writer($id_moneda,$lines){

        $fileName = sprintf(
            '%s_%s_%s_%s.txt',
            $this->co_subasta,
            $this->fileNumber,
            $this->bankCode,
            $id_moneda
        );
        //GENERO EL ARCHIVO
        Storage::disk('local')->put($this->directory.'/'.$fileName, $lines);
        $fileResults = ['file' => $fileName, 'created' => 'true'];
        

        //ENVIO CADA ARCHIVO
        // $serviceResult = $this->serviceHandler->uploadFile($this->fileNumber, $fileName);        
        $serviceResult['status']='200';

        if($serviceResult['status'] == '200')
        {
            $fileResults = array_merge($fileResults, ['uploaded' => 'true']);
        } 
        else 
        {
            $fileResults = array_merge($fileResults, ['uploaded' => 'false']);
        }
        //AGREGO EL RESULTADO
        
        if(in_array('false', $fileResults)){
            return 'false';
        }else{
            return 'true';
        }
    }
}
