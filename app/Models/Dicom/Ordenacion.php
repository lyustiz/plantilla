<?php

namespace App\Http\Models\Dicom;

use Illuminate\Database\Eloquent\Model;

class Ordenacion extends Model
{
    protected $connection = 'dicom';
    protected $table = 'ordenacion';
    protected $primaryKey = 'id_ordenacion';


    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function detallesOrdenacion(){
        return $this->hasMany(
            'App\Http\Models\Dicom\DetOrdenacion', 
            'id_ordenacion'
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
