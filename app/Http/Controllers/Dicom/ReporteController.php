<?php

namespace App\Http\Controllers\Dicom;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Http\Models\Dicom\Subasta;
use App\Http\Models\Dicom\Solicitud;
use App\Http\Models\Dicom\Transferencia;
use App\Http\Models\Dicom\Ordenacion;

use App\Http\Models\General\Cliente;
use App\Http\Models\General\Banco;
use App\Http\Models\General\Status;

use App\User;

class ReporteController extends Controller
{
    protected $grteFiduciarias='Angel Chaparro';
    protected $grteCambiarias='Jonifer Alexander Delgado';
    protected $grteAdmFondos='Carlos Montes';

    protected $pdf;
    
    /**
     * ReporteController index
     */
    public function index($id_subasta)
    {
        $this->pdf = app('FPDF');

        $subasta = Subasta::find($id_subasta);

        if($subasta['id_status'] == 17){
            $solicitud = Solicitud::with('detallesSolicitud')
                                    ->with('moneda:co_bcv,nb_moneda')
                                    ->where('id_subasta', $id_subasta)
                                    ->get();

            $transferencia=Transferencia::with('detTransferencia')
                            ->with('moneda:co_bcv,nb_moneda')
                            ->where('id_subasta', $id_subasta)
                            ->get();

            $ordenacion=Ordenacion::with('detallesOrdenacion')
                            ->with('moneda:co_bcv,nb_moneda')
                            ->where('id_subasta', $id_subasta)
                            ->get();

            $userSubasta=User::find($subasta->id_usuario);
            $userAprob=User::find($subasta->id_usuario);

            foreach ($solicitud as $key => $value) {

                $this->generador(
                            $subasta,
                            $solicitud[$key],
                            $transferencia[$key],
                            $ordenacion[$key],
                            $userSubasta,
                            $userAprob
                        );
            }

            // //save file
            $headers=['Content-Type'=>'application/pdf'];
            return Response($this->pdf->Output(), 200, $headers);
            
        }else{

            return redirect('/subasta');
        }
    }

    public function generador($subasta,$solicitud,$transferencia,$ordenacion,$userSubasta,$userAprob){

        // Cabecera y Solicitudes
        $this->pdf->AddPage();
        $this->pdf->Image('images/opcam/dicom.jpg',165,14,29,10,'JPG');
        $this->pdf->Image('images/opcam/logoDos.png',15,10,30,15,'PNG');

        $this->pdf->SetFont('Arial','B',6);
        $this->pdf->Cell(190,2,'Reporte Dicom '.$subasta['co_subasta'],0,1,'C');
        $this->pdf->Ln(1);
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(190,5,'CONSTANCIA DICOM',0,1,'C');
        $this->pdf->Ln(1);
        $this->pdf->SetFont('Arial','B',6);
        $this->pdf->Cell(190,2,utf8_decode('Gerencia Ejecutiva de Administración de Fondos  y Operaciones cambiarias '),0,0.5,'C');
        $this->pdf->Ln(1);
        $this->pdf->Cell(190,1,utf8_decode('Gerencia de Operaciones cambiarias '),0,0,'C');


        $this->pdf->Ln(5);
        $this->pdf-> SetFillColor(234, 231, 230);
        $this->pdf->SetFont('Arial','B',8);
        $this->pdf->Cell(190,4,"INFORMACION DE CASO",1,1,'C',true);
        $this->pdf->SetXY(10, 31);
        $this->pdf->Cell(190, 240, '', 1 , 1);
        $this->pdf->SetXY(15, 35);
        $this->pdf->Cell(55, 5, 'FECHA INICIO SUBASTA', 1 , 1,'C');
        $this->pdf->SetXY(70, 35);
        $this->pdf->Cell(70, 5, 'FECHA CIERRE DE SUBASTA', 1 , 1,'C');
        $this->pdf->SetXY(140, 35);
        $this->pdf->Cell(50, 5, 'CODIGO SUBASTA', 1 , 1,'C');
        $this->pdf->SetXY(15, 40);
        $this->pdf->Cell(55, 5, Carbon::parse($subasta['fe_subasta'])->Format('d-m-Y'), 1 , 1,'C') ;
        $this->pdf->SetXY(70, 40);
        $this->pdf->Cell(70, 5, Carbon::parse($subasta['fe_cierre'])->Format('d-m-Y'), 1 , 1,'C');
        $this->pdf->SetXY(140, 40);
        $this->pdf->Cell(50, 5, $subasta['nu_subasta'], 1 , 1,'C');
        $this->pdf->SetXY(10, 48);
        $this->pdf->Cell(190,5,utf8_decode("INFORMACION DE COMPROBACIÓN"),1,1,'C',true);
        $this->pdf->SetXY(15, 55);
        $this->pdf->Cell(55, 5, utf8_decode("N° SUBASTA"), 1 , 1,'C');
        $this->pdf->SetXY(70, 55);
        $this->pdf->Cell(70, 5, 'CANTIDAD DE POSTURAS', 1 , 1,'C');
        $this->pdf->SetXY(140, 55);
        $this->pdf->Cell(50, 5, 'CANTIDAD OFERTAS', 1 , 1,'C');
        $this->pdf->SetXY(15, 60);
        $this->pdf->Cell(55, 5, $subasta['co_subasta'], 1 , 1,'C');
        $this->pdf->SetXY(70, 60);   
        $this->pdf->Cell(70, 5,number_format($solicitud['nu_postura'],0,',','.'), 1 , 1,'C');
        $this->pdf->SetXY(140, 60);         
        $this->pdf->Cell(50, 5,number_format($solicitud['nu_ofertas'],0,',','.'), 1 , 1,'C');
        $this->pdf->SetXY(15, 67);
        $this->pdf->Cell(55, 5, 'DIVISAS DEMANDA', 1 , 1,'C');
        $this->pdf->SetXY(70, 67);
        $this->pdf->Cell(70, 5, 'DIVISA OFERTA', 1 , 1,'C');
        $this->pdf->SetXY(140, 67);
        $this->pdf->Cell(50, 5, 'BOLIVARES OFERTAS', 1 , 1,'C');
        $this->pdf->SetXY(15, 72);
        $this->pdf->Cell(55, 5,number_format($solicitud['nu_div_demanda'], 2, ',', '.'), 1 , 1,'C');
        $this->pdf->SetXY(70, 72);
        $this->pdf->Cell(70, 5,  number_format($solicitud['nu_div_oferta'], 2, ',', '.'), 1 , 1,'C');
        $this->pdf->SetXY(140, 72);
        $this->pdf->Cell(50, 5, number_format($solicitud['nu_bs_oferta'], 2, ',', '.'), 1 , 1,'C');
        $this->pdf->SetXY(15, 77);
        $this->pdf->SetFont('Arial','B',6);
        $this->pdf->Cell(55, 5, 'SUBASTA CREADA POR:', 1 , 1,'C');
        $this->pdf->SetFont('Arial','B',5.9);
        $this->pdf->SetXY(15, 82);  
        $this->pdf->Cell(55, 5,$userSubasta['nb_completo'], 1 , 1,'C');   
        $this->pdf->SetXY(70, 77);
        $this->pdf->SetFont('Arial','B',6);
        $this->pdf->Cell(70, 5, 'SUBASTA APROBADA POR:', 1 , 1,'C');
        $this->pdf->SetXY(70, 82);
        $this->pdf->SetFont('Arial','B',5.9);
        $this->pdf->Cell(70, 5,$userAprob['nb_completo'], 1 , 1,'C');   
        $this->pdf->SetXY(10, 90);
        $this->pdf->Cell(190,5,"DENOMINACIONES DE APORTES ",1,1,'C',true);

        foreach ($solicitud->detallesSolicitud as $key => $detSolicitud) {
            $i = $key +1;

            $estado= Status::where('id_status',$detSolicitud['id_status'])
                            ->pluck('nb_status');
            $estado = count($estado) > 0 ? ucwords($estado[0]) : 'null';

            $this->pdf->SetXY(15, 70+($i*27));
            $this->pdf->Cell(60, 5, utf8_decode('ESTADO DE LA OPERACIÓN:  '.$estado), 1,'C');
            $this->pdf->SetFont('Arial','B',6);
            $this->pdf->SetXY(15, 75+($i*27));
            $this->pdf->Cell(30, 5, utf8_decode('FECHA OPERACIÓN'), 1,'C');
            $this->pdf->Cell(30, 5, 'FECHA VALOR', 1,'C');
            $this->pdf->Cell(30, 5,utf8_decode('N° SOLICITUD'), 1,'C');          
            $this->pdf->Cell(30, 5, 'RIF', 1,'C');    
            $this->pdf->Cell(30, 5, 'MONTO BOLIVARES', 1,'C');
            $this->pdf->Cell(30, 5, 'MONTO DIVISAS', 1,'C');        
            $this->pdf->SetXY(15, 80+($i*27));
            $this->pdf->Cell(30, 5,Carbon::parse($detSolicitud['fe_operacion'])->Format('d-m-Y'), 1 , 1,'C');
            $this->pdf->SetXY(45, 80+($i*27));
            $this->pdf->Cell(30, 5,Carbon::parse($detSolicitud['fe_valor'])->Format('d-m-Y'), 1 , 1,'C');        
            $this->pdf->SetXY(75, 80+($i*27));
            $this->pdf->Cell(30, 5,$detSolicitud['nu_solicitud'], 1 , 1,'C');
            $this->pdf->SetXY(105, 80+($i*27));
            $this->pdf->Cell(30, 5,$detSolicitud['tx_rif'], 1 , 1,'C');        
            $this->pdf->SetXY(135, 80+($i*27));       
            $this->pdf->Cell(30, 5,number_format($detSolicitud['ca_monto_bsf'], 2, ',', '.'), 1 , 1,'C');
            $this->pdf->SetXY(165, 80+($i*27));      
            $this->pdf->Cell(30, 5,number_format($detSolicitud['ca_monto_div'], 2, ',', '.'), 1 , 1,'C');
            $this->pdf->SetXY(15, 85+($i*27));

            $cliente = Cliente::where('tx_rif', $detSolicitud['tx_rif'])->pluck('nb_cliente');
            // dd(count($cliente),$cliente[0]);
            $cliente = count($cliente) > 0 ? ucwords($cliente[0]) : $detSolicitud['tx_rif'];

            $this->pdf->Cell(60, 5, 'CLIENTE',1, 1,'C');
            $this->pdf->SetXY(15, 90+($i*27));        
            $this->pdf->Cell(60, 5,$cliente,1,1,'C');
            $this->pdf->SetXY(75, 85+($i*27)); 
            $this->pdf->Cell(60, 5, 'CUENTA BOLIVARES',1, 1,'C');
            $this->pdf->SetXY(135, 85+($i*27)); 
            $this->pdf->Cell(60, 5, 'CUENTA DIVISAS',1, 1,'C');
            $this->pdf->SetXY(75, 90+($i*27));        
            $this->pdf->Cell(60, 5,$detSolicitud['tx_cta_bsf'], 1 , 1,'C');
            $this->pdf->SetXY(135, 90+($i*27));        
            $this->pdf->Cell(60, 5,$detSolicitud['tx_cta_div'], 1 , 1,'C');
        }

        // Transferencias Interbancarias 

        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial','B',6);
        $this->pdf->Ln(5);
        $this->pdf-> SetFillColor(234, 231, 230);
        $this->pdf->SetFont('Arial','B',6);
        $this->pdf->Cell(190,5,"TRASFERENCIAS INTERBANCARIAS",1,1,'C',true);
        $this->pdf->SetXY(10, 31);
        $this->pdf->Cell(190, 240, '', 1 , 1);
        $this->pdf->SetXY(15, 35);
        $this->pdf->Cell(25, 5, utf8_decode('N° SUBASTA'), 1 , 1,'C');
        $this->pdf->SetXY(15, 40);
        $this->pdf->Cell(25, 5, $subasta['co_subasta'], 1 , 1,'C');
        $this->pdf->SetXY(40, 35);
        $this->pdf->Cell(25, 5, 'FECHA SUBASTA', 1 , 1,'C');
        $this->pdf->SetXY(40, 40);
        $this->pdf->Cell(25, 5, Carbon::parse($subasta['fe_subasta'])->Format('d-m-Y'), 1 , 1,'C');
        $this->pdf->SetXY(65, 35);
        $this->pdf->Cell(40, 5, 'Bs.S A ENVIAR', 1 , 1,'C');
        $this->pdf->SetXY(65, 40);
        $this->pdf->Cell(40, 5, number_format($transferencia['nu_bsf_enviar'], 2, ',', '.'), 1 , 1,'C');  
        $this->pdf->SetXY(105, 35);
        $this->pdf->Cell(35, 5, 'Bs.S A RECIBIR', 1 , 1,'C');
        $this->pdf->SetXY(105, 40);
        $this->pdf->Cell(35, 5, number_format($transferencia['nu_bsf_recibir'], 2, ',', '.'), 1 , 1,'C');
        $this->pdf->SetXY(140, 35);
        $this->pdf->Cell(35, 5, 'DIVISAS A RECIBIR', 1 , 1,'C');
        $this->pdf->SetXY(140, 40);
        $this->pdf->Cell(35, 5, number_format($transferencia['nu_div_recibir'], 2, ',', '.'), 1 , 1,'C');
        $this->pdf->SetXY(175, 35);
        $this->pdf->Cell(20, 5, 'MONEDA', 1 , 1,'C');
        $this->pdf->SetXY(175, 40);
        $this->pdf->Cell(20, 5, $transferencia->moneda['nb_moneda'], 1 , 1,'C');
        $this->pdf->SetXY(30,63-12);
        $this->pdf->Cell(25, 5,'Bs.S A ENVIAR', 1,'C');
        $this->pdf->SetXY(55,63-12);        
        $this->pdf->Cell(25, 5,'Bs.S A RECIBIR', 1,'C');
        $this->pdf->SetXY(80,63-12);        
        $this->pdf->Cell(25, 5,'DIVISAS A ENVIAR', 1,'C');
        $this->pdf->SetXY(105,63-12);        
        $this->pdf->Cell(25, 5,'DIVISAS A RECIBIR', 1,'C');
        $this->pdf->SetXY(130,63-12);        
        $this->pdf->Cell(25, 5,utf8_decode('FECHA OPERACIÓN'), 1,'C');
        $this->pdf->SetXY(155,63-12);        
        $this->pdf->Cell(25, 5,utf8_decode('FECHA VALOR'), 1,'C');

        foreach ($transferencia->detTransferencia as $key => $detTransf) {
            $i = $key +1;

            $banco=Banco::where('co_banco',$detTransf['id_banco'])
                        ->pluck('nb_banco');
            $banco = count($banco) > 0 ? ucwords($banco[0]) : $detTransf['id_banco'];

            $this->pdf->SetXY(15+15, 48+($i*14));
            $this->pdf->Cell(25, 5,number_format($detTransf['nu_bsf_enviar'], 2, ',', '.'),1, 1,'C');
            $this->pdf->SetXY(40+15, 48+($i*14));
            $this->pdf->Cell(25, 5,number_format($detTransf['nu_bsf_recibir'], 2, ',', '.'),1, 1,'C');
            $this->pdf->SetXY(65+15, 48+($i*14));
            $this->pdf->Cell(25, 5,number_format($detTransf['nu_div_enviar'], 2, ',', '.'),1, 1,'C');
            $this->pdf->SetXY(90+15, 48+($i*14));
            $this->pdf->Cell(25, 5,number_format($detTransf['nu_div_recibir'], 2, ',', '.'),1, 1,'C');
            $this->pdf->SetXY(115+15, 48+($i*14));
            $this->pdf->Cell(25, 5,Carbon::parse($detTransf['fe_operacion'])->Format('d-m-Y'),1, 1,'C');
            $this->pdf->SetXY(140+15, 48+($i*14));
            $this->pdf->Cell(25, 5,Carbon::parse($detTransf['fe_valor'])->Format('d-m-Y'),1, 1,'C');
            $this->pdf->SetXY(15+15, 43+($i*14));
            $this->pdf->Cell(75, 5, utf8_decode('BANCO:  '.$banco),1,1,1,'C');
        }

        //Ordenación de desbloqueos, créditos y débitos a la Banca

        $this->pdf->AddPage();
        $this->pdf->Ln(5);
        $this->pdf-> SetFillColor(234, 231, 230);
        $this->pdf->SetFont('Arial','B',5.7);
        $this->pdf->Cell(190,5,utf8_decode("ORDENACION DE DESBLOQUEOS, CRÉDITO Y DEBITO"),1,1,'C',true);
        $this->pdf->SetXY(10, 31);
        $this->pdf->Cell(190, 240, '', 1 , 1);
        $this->pdf->SetXY(15, 35);
        $this->pdf->Cell(15, 5, utf8_decode('SUBASTA'), 1 , 1,'C');
        $this->pdf->SetXY(15, 40);
        $this->pdf->Cell(15, 5, $subasta['co_subasta'], 1 , 1,'C');
        $this->pdf->SetXY(30, 35);
        $this->pdf->Cell(20, 5, 'MONEDA', 1 , 1,'C');
        $this->pdf->SetXY(30, 40);
        $this->pdf->Cell(20, 5,$ordenacion->moneda['nb_moneda'], 1 , 1,'C');
        $this->pdf->SetXY(50, 35);
        $this->pdf->Cell(17, 5, 'OPERACIONES', 1 , 1,'C');
        $this->pdf->SetXY(50, 40);
        $this->pdf->Cell(17, 5,number_format($solicitud[0]['nu_ofertas'],0,',','.'), 1 , 1,'C');  
        $this->pdf->SetXY(67, 35);
        $this->pdf->Cell(23, 5, 'Bs.S a Desbloquear', 1 , 1,'C');
        $this->pdf->SetXY(67, 40);
        $this->pdf->Cell(23, 5, number_format($ordenacion['nu_bsf_desbloquear'], 2, ',', '.'), 1 , 1,'C');
        $this->pdf->SetXY(90, 35);
        $this->pdf->Cell(25, 5, 'Divisas a Desbloquear', 1 , 1,'C');
        $this->pdf->SetXY(90, 40);
        $this->pdf->Cell(25, 5, number_format($ordenacion['nu_div_desbloquear'], 2, ',', '.'), 1 , 1,'C');
        $this->pdf->SetXY(115, 35);
        $this->pdf->Cell(20, 5, 'Bs.S A Acreditar', 1 , 1,'C');
        $this->pdf->SetXY(115, 40);
        $this->pdf->Cell(20, 5, number_format($ordenacion['nu_bsf_acreditar'], 2, ',', '.'), 1 , 1,'C');
        $this->pdf->SetXY(135, 35);
        $this->pdf->Cell(20, 5, 'Divisas A Acreditar', 1 , 1,'C');
        $this->pdf->SetXY(135, 40);
        $this->pdf->Cell(20, 5, number_format($ordenacion['nu_div_acreditar'], 2, ',', '.'), 1 , 1,'C');
        $this->pdf->SetXY(155, 35);
        $this->pdf->Cell(20, 5, 'Bs.S a Debitar', 1 , 1,'C');
        $this->pdf->SetXY(155, 40);
        $this->pdf->Cell(20, 5, number_format($ordenacion['nu_bsf_debitar'], 2, ',', '.'), 1 , 1,'C');
        $this->pdf->SetXY(175, 35);
        $this->pdf->Cell(20, 5, 'Divisas a Debitar', 1 , 1,'C');
        $this->pdf->SetXY(175, 40);
        $this->pdf->Cell(20, 5, number_format($ordenacion['nu_div_debitar'], 2, ',', '.'), 1 , 1,'C');
        $this->pdf->SetXY(15, 55);
        $this->pdf->Cell(15, 5, utf8_decode('SOLICITUD'), 1 , 1,'C');
        $this->pdf->SetXY(30, 55);
        $this->pdf->Cell(23, 5, utf8_decode('Bs.S a Desbloquear'), 1 , 1,'C');
        $this->pdf->SetXY(53, 55);
        $this->pdf->Cell(23, 5, utf8_decode('Divisas a Desbloquear'), 1 , 1,'C');
        $this->pdf->SetXY(76, 55);
        $this->pdf->Cell(20, 5, utf8_decode('Bs.S a Acreditar'), 1 , 1,'C');
        $this->pdf->SetXY(96, 55);
        $this->pdf->Cell(20, 5, utf8_decode('Divisas a Acreditar'), 1 , 1,'C');
        $this->pdf->SetXY(116, 55);
        $this->pdf->Cell(20, 5, utf8_decode('Bs.S a Debitar'), 1 , 1,'C');
        $this->pdf->SetXY(136, 55);
        $this->pdf->Cell(20, 5, utf8_decode('Divisas a Debitar'), 1 , 1,'C');
        $this->pdf->SetXY(156, 55);
        $this->pdf->Cell(21, 5, utf8_decode('Fecha de Operación'), 1 , 1,'C');
        $this->pdf->SetXY(177, 55);
        $this->pdf->Cell(18, 5, utf8_decode('Fecha de Valor'), 1 , 1,'C');


        foreach ($ordenacion->detallesOrdenacion as $key => $detOrdenacion) {
            $i = $key +1;

            $this->pdf->SetXY(15, 56+($i*9));
            $this->pdf->Cell(15, 5, $detOrdenacion['nu_solicitud'],1,1, 'C');
            $this->pdf->SetXY(30, 56+($i*9));
            $this->pdf->Cell(23, 5,number_format($detOrdenacion['nu_bsf_desbloqueo'], 2, ',', '.'),1,1, 'C');
            $this->pdf->SetXY(53, 56+($i*9));
            $this->pdf->Cell(23, 5,number_format($detOrdenacion['nu_div_desbloqueo'], 2, ',', '.'),1,1, 'C');
            $this->pdf->SetXY(76, 56+($i*9));
            $this->pdf->Cell(20, 5,number_format($detOrdenacion['nu_bsf_acreditar'], 2, ',', '.'),1,1, 'C');
            $this->pdf->SetXY(96, 56+($i*9));
            $this->pdf->Cell(20, 5,number_format($detOrdenacion['nu_div_acreditar'], 2, ',', '.'),1,1, 'C');
            $this->pdf->SetXY(116, 56+($i*9));
            $this->pdf->Cell(20, 5,number_format($detOrdenacion['nu_bsf_debitar'], 2, ',', '.'),1,1, 'C');
            $this->pdf->SetXY(136, 56+($i*9));
            $this->pdf->Cell(20, 5,number_format($detOrdenacion['nu_div_debitar'], 2, ',', '.'),1,1, 'C');
            $this->pdf->SetXY(156, 56+($i*9));
            $this->pdf->Cell(20, 5,Carbon::parse($detOrdenacion['fe_operacion'])->Format('d-m-Y'),1,1, 'C');
            $this->pdf->SetXY(176, 56+($i*9));
            $this->pdf->Cell(19, 5,Carbon::parse($detOrdenacion['fe_valor'])->Format('d-m-Y'),1,1, 'C');
            $this->pdf->SetXY(15, 61+($i*9));

            $corelativo = "N° Abono: ".str_pad($detOrdenacion['nu_abono'],10,"0",STR_PAD_LEFT);
            $corelativo = $corelativo." | N° Debito:  ".str_pad($detOrdenacion['nu_debito'],10,"0",STR_PAD_LEFT);
            $corelativo = utf8_decode($corelativo);

            $this->pdf->Cell(61,4,$corelativo,1,1,'L',true);
        }

        //##############################################################

        $this->pdf->SetXY(10, 190);
        $this->pdf->Cell(190,5,"OBSERVACIONES ",1,1,'C',true);
        $this->pdf-> SetFillColor(253, 249, 252);
        //linea 
        $this->pdf->SetXY(10, 201);       
        $this->pdf->Cell(190,0," *--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0.5,1,'l',true);
        $this->pdf->SetXY(10, 201+5);
        $this->pdf->Cell(190,0," *--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0.5,1,'l',true);
        $this->pdf->SetXY(10, 201+10);
        $this->pdf->Cell(190,0," *--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0.5,1,'l',true);
        $this->pdf->SetXY(10, 201+15);       
        $this->pdf->Cell(190,0," *--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0.5,1,'l',true);
        $this->pdf->SetXY(10, 201+20);
        $this->pdf->Cell(190,0," *--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0.5,1,'l',true);
        $this->pdf-> SetFillColor(234, 231, 230);
        $this->pdf->SetXY(10, 227);
        $this->pdf->Cell(190,5,"FIRMAS AUTORIZADAS ",1,1,'C',true);

        if ($subasta['co_subasta'] <=1026 ){
            $this->pdf->SetXY(15+5, 250);
            $this->pdf->Cell(30, 5, utf8_decode('        Gerente de Operaciones Fiduciarias                                                                                                                  G.E de Administración de Fondos y Operaciones Cambiarias '), 0, 1,'t');
            $this->pdf->SetFillColor(253, 249, 252);
            $this->pdf->SetXY(15+10, 245);
            $this->pdf->Cell(15,0,"   ______________________________                                                                                                                                         ______________________________                                          ",0.5,1,'l',true);
            $this->pdf->SetXY(25, 245);
            $this->pdf->Cell(40, 5, utf8_decode('                    '.$this->grteFiduciarias.'                                                                                                                                                                           '.$this->grteAdmFondos.' '), 0, 1,'t');
        }
        else{
            $this->pdf->SetXY(15+5, 250);
            $this->pdf->Cell(30, 5, utf8_decode('        Gerente de Operaciones Fiduciarias                                             Gerente de operaciones Cambiarias                                G.E de Administración de Fondos y Operaciones Cambiarias '), 0, 1,'t');
            $this->pdf->SetFillColor(253, 249, 252);
            $this->pdf->SetXY(15+10, 245);
            $this->pdf->Cell(15,0,"   ______________________________                                          ______________________________                                                    ______________________________                                          ",0.5,1,'l',true);
            $this->pdf->SetXY(25, 245);
            $this->pdf->Cell(40, 5, utf8_decode('                    '.$this->grteFiduciarias.'                                                                    '.$this->grteCambiarias.'                                                                              '.$this->grteAdmFondos.' '), 0, 1,'t');
        }
    }


    public function rango(Request $request) 
    {
    	//EN DESSARROLLO
        $rangoFecha=$request->toArray();
        $inicio=$rangoFecha['inicio'];
        $final=$rangoFecha['final'];
        // dd($inicio,$final);

        $this->pdf = app('FPDF');
        $this->pdf->AddPage();
        //$this->pdf->SetX(100);

        $this->pdf->Image('images/opcam/dicom.jpg',165,14,29,10,'JPG');
        $this->pdf->Image('images/opcam/logoDos.png',15,10,30,15,'PNG');
        //$this->pdf->SetXY(150, 31);
        //$this->pdf->Image('img/dicom.jpg',15,10,30,15,'JPG');

        $this->pdf->SetFont('Arial','B',6);
        $this->pdf->Cell(190,2,'Reporte Dicom ',0,1,'C');
        $this->pdf->Ln(1);
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(190,5,'CONSTANCIA DICOM',0,1,'C');
        $this->pdf->Ln(1);
        $this->pdf->SetFont('Arial','B',6);
        $linea = utf8_decode('Gerencia Ejecutiva de Administración de Fondos  y Operaciones cambiarias ');
        $this->pdf->Cell(190,2,$linea,0,0.5,'C');
        $this->pdf->Ln(1);
        $this->pdf->Cell(190,1,utf8_decode('Gerencia de Operaciones cambiarias '),0,0,'C');


        $this->pdf->Ln(5);
        $this->pdf-> SetFillColor(234, 231, 230);
        $this->pdf->SetFont('Arial','B',8);
        $this->pdf->Cell(190,4,"INFORMACION DE CASO",1,1,'C',true);


        $this->pdf->Cell(190, 240, '', 1 , 1);
        $this->pdf->SetXY(15, 35);
        $this->pdf->Cell(55, 5, 'FECHA INICIO SUBASTA', 1 , 1,'C');
        $this->pdf->SetXY(70, 35);
        $this->pdf->Cell(70, 5, 'FECHA FINAL SUBASTA', 1 , 1,'C');


        $this->pdf->Cell(55, 5, $inicio, 1 , 1,'C');
        $this->pdf->SetXY(70, 40);
        $this->pdf->Cell(70, 5, $final, 1 , 1,'C');

        $headers=['Content-Type'=>'application/pdf'];
        return Response($this->pdf->Output(), 200, $headers);
    }

}
