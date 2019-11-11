<?php

namespace App\Http\Models\General;

use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    protected $connection = 'general';
    protected $table = 'operacion';
    protected $primaryKey = 'id_operacion';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function scopeGrupo($query, $id_grupo)
    {
        return $query->where('tx_grupo', $id_grupo);
    }
}
