<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Visitante extends Pivot
{
    protected $table 	  = 'visitante';
	protected $primaryKey = 'id_visitante';
	
	const 	  CREATED_AT  = 'fe_creado';
	const 	  UPDATED_AT  = 'fe_actualizado';

    protected $fillable   = [
                            'id_visitante',
	 	 	 	 	 	 	'id_status',
	 	 	 	 	 	 	'id_usuario',
	 	 	 	 	 	 	'tx_nombres',
	 	 	 	 	 	 	'tx_apellidos',
	 	 	 	 	 	 	'nu_cedula',
	 	 	 	 	 	 	'tx_nacionalidad',
	 	 	 	 	 	 	'tx_foto',
	 	 	 	 	 	 	'tx_cod_pais',
	 	 	 	 	 	 	'tx_telefono'
                            ]; 
    
    protected $hidden     = [
                            'fe_creado',
	 	 	 	 	 	 	'fe_actualizado'
                            ];

    public function visitante()
    {
        return $this->belongsTo('App\Models\Visitante', 'id_visitante');
    } 

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'id_status');
    } 

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'id_usuario');
    } 
}
