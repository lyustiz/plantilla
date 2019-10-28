<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Bitacora extends Pivot
{
    protected $table 	  = 'bitacora';
	protected $primaryKey = 'id_bitacora';
	
	const 	  CREATED_AT  = 'fe_creado';
	const 	  UPDATED_AT  = 'fe_actualizado';

    protected $fillable   = [
                            'id_bitacora',
	 	 	 	 	 	 	'id_usuario',
	 	 	 	 	 	 	'co_accion',
	 	 	 	 	 	 	'tx_tabla',
	 	 	 	 	 	 	'in_id_tabla',
	 	 	 	 	 	 	'tx_old_valor',
	 	 	 	 	 	 	'tx_new_valor',
	 	 	 	 	 	 	'fe_accion'
                            ]; 
    
    protected $hidden     = [
                            'fe_creado',
	 	 	 	 	 	 	'fe_actualizado'
                            ];

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'id_usuario');
    } 
}
