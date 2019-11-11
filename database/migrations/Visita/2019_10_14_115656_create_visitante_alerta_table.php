<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitanteAlertaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visitante_alerta', function(Blueprint $table)
		{
			$table->integer('id_visitante_alerta', true);
			$table->integer('id_visitante');
			$table->integer('id_tipo_alerta');
			$table->integer('id_visita');
			$table->string('tx_motivo_alerta')->nullable();
			$table->string('tx_anulacion')->nullable();
			$table->integer('id_status');
			$table->dateTime('fe_creado');
			$table->dateTime('fe_actualizado')->nullable();
			$table->integer('id_usuario');

			$table->foreign('id_visitante',  'fk_visitante_alerta_visitante')->references('id_visitante')->on('visitante');
			$table->foreign('id_visita', 	 'fk_visitante_alerta_visita')->references('id_visita')->on('visita');
			$table->foreign('id_tipo_alerta','fk_visitante_alerta_tipo_alerta')->references('id_tipo_alerta')->on('tipo_alerta');
			$table->foreign('id_status', 	 'fk_visitante_alerta_status')->references('id_status')->on('status');
			$table->foreign('id_usuario', 	 'fk_visitante_alerta_usuario')->references('id_usuario')->on('usuario');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('visitante_alerta');
	}

}
