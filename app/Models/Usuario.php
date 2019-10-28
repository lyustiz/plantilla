<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Usuario extends Pivot
{
    protected $table 	  = 'usuario';
	protected $primaryKey = 'id_usuario';
	
	const 	  CREATED_AT  = 'fe_creado';
	const 	  UPDATED_AT  = 'fe_actualizado';

    protected $fillable   = [
                            'id_usuario',
	 	 	 	 	 	 	'id_status',
	 	 	 	 	 	 	'nb_usuario',
	 	 	 	 	 	 	'password',
	 	 	 	 	 	 	'tx_correo',
	 	 	 	 	 	 	'nu_cedula',
	 	 	 	 	 	 	'nb_p_nombre',
	 	 	 	 	 	 	'nb_s_nombre',
	 	 	 	 	 	 	'nb_p_apellido',
	 	 	 	 	 	 	'nb_s_apellido',
	 	 	 	 	 	 	'tx_nacionalidad',
	 	 	 	 	 	 	'tx_rif',
	 	 	 	 	 	 	'tx_telefono',
	 	 	 	 	 	 	'id_usuario_c'
                            ]; 
    
    protected $hidden     = [
                            'fe_creado',
	 	 	 	 	 	 	'fe_actualizado'
                            ];

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'id_status');
    } 
}
