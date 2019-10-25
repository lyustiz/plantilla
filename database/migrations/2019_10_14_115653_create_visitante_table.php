<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitanteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visitante', function(Blueprint $table)
		{
			$table->integer('id_visitante', true);
			$table->string('tx_nombres', 50)->nullable();
			$table->string('tx_apellidos', 50)->nullable();
			$table->string('nu_cedula', 10)->nullable();
			$table->string('tx_nacionalidad', 1)->nullable();
			$table->string('tx_foto')->nullable();
			$table->string('tx_cod_pais')->nullable();
			$table->string('tx_telefono', 20)->nullable();
			$table->integer('id_status')->nullable();
			$table->dateTime('fe_creado')->nullable();
			$table->dateTime('fe_actualizado')->nullable();
			$table->integer('id_usuario')->nullable();

			$table->foreign('id_visitante',  'fk_visitante_alerta_visitante')->references('id_visitante')->on('visitante');
			$table->foreign('id_visita', 	 'fk_visitante_alerta_visita')->references('id_visita')->on('visita');
			$table->foreign('id_tipo_alerta','fk_visitante_alerta_tipo_alerta')->references('id_tipo_alerta')->on('tipo_alerta');
			$table->foreign('id_motivo', 	 'fk_visitante_alerta_motivo')->references('id_motivo')->on('motivo');
			$table->foreign('id_status', 	 'fk_visitante_alerta_status')->references('id_usuario')->on('status');
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
		Schema::drop('visitante');
	}

}
