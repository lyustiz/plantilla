<?php

namespace App\Http\Models\Dicom;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'dicom.solicitud';
    protected $primaryKey = 'id_solicitud';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function detallesSolicitud(){
        return $this->hasMany(
            'App\Http\Models\Dicom\DetSolicitud', 
            'id_solicitud'
        );
    }

    public function moneda()
    {
        return $this->belongsTo(
            'App\Http\Models\General\Moneda',
            'id_moneda',
            'co_bcv'
        );
    }
}
