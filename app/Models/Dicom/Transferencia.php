<?php

namespace App\Http\Models\Dicom;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $connection = 'dicom';
    protected $table = 'transferencia';
    protected $primaryKey = 'id_transferencia';


    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function detTransferencia(){
        return $this->hasMany(
            'App\Http\Models\Dicom\DetTransferencia', 
            'id_transferencia'
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
