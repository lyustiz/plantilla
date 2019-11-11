<?php

namespace App\Http\Models\Dicom;

use Illuminate\Database\Eloquent\Model;

class DetOrdenacion extends Model
{
    protected $connection = 'dicom';
    protected $table = 'det_ordenacion';
    protected $primaryKey = 'id_ordenacion';


    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function ordenacion(){
        return $this->belongsTo(
            'App\Http\Models\Dicom\Ordenacion', 
            'id_ordenacion', 
            'id_ordenacion'
        );
    }
}
