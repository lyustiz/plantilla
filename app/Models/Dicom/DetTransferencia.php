<?php

namespace App\Http\Models\Dicom;

use Illuminate\Database\Eloquent\Model;

class DetTransferencia extends Model
{
    protected $connection = 'dicom';
    protected $table = 'det_transferencia';
    protected $primaryKey = 'id_det_transferencia';


    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function transferencia(){
        return $this->belongsTo(
            'App\Http\Models\Dicom\Transferencia', 
            'id_transferencia', 
            'id_transferencia'
        );
    }
}
