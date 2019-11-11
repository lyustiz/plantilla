<?php

namespace App\Http\Models\Dicom;

use Illuminate\Database\Eloquent\Model;

class DetSolicitud extends Model
{
    
    protected $connection = 'dicom';
    protected $table = 'det_solicitud';
    protected $primaryKey = 'id_det_solicitud';


    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function solicitud(){
        return $this->belongsTo(
            'App\Http\Models\Dicom\Solicitud', 
            'id_solicitud', 
            'id_solicitud'
        );
    }

    public function status(){
        return $this->belongsTo(
            'App\Http\Models\General\Status', 
            'id_status', 
            'id_status'
        );
    }

}
