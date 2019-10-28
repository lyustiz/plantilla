<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class VisitanteAlerta extends Pivot
{
    protected $table 	  = 'visitante_alerta';
	protected $primaryKey = 'id_visitante_alerta';
	
	const 	  CREATED_AT  = 'fe_creado';
	const 	  UPDATED_AT  = 'fe_actualizado';

    protected $fillable   = [
                            'id_visitante_alerta',
	 	 	 	 	 	 	'id_visitante',
	 	 	 	 	 	 	'id_tipo_alerta',
	 	 	 	 	 	 	'id_visita',
	 	 	 	 	 	 	'id_status',
	 	 	 	 	 	 	'id_usuario',
	 	 	 	 	 	 	'tx_motivo_alerta',
	 	 	 	 	 	 	'tx_anulacion'
                            ]; 
    
    protected $hidden     = [
                            'fe_creado',
	 	 	 	 	 	 	'fe_actualizado'
                            ];

    public function visitante()
    {
        return $this->belongsTo('App\Models\Visitante', 'id_visitante');
    } 

    public function visita()
    {
        return $this->belongsTo('App\Models\Visita', 'id_visita');
    } 

    public function tipoAlerta()
    {
        return $this->belongsTo('App\Models\TipoAlerta', 'id_tipo_alerta');
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
