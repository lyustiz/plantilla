<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visita', function(Blueprint $table)
		{
			$table->integer('id_visita', true);
			$table->integer('id_visitante');
			$table->integer('id_tipo_visitante');
			$table->integer('nu_ced_empleado');
			$table->integer('id_empresa');
			$table->text('tx_cargo')->nullable();
			$table->integer('id_motivo');
			$table->string('tx_observaciones', 500)->nullable();
			$table->decimal('nu_carnet', 5, 0)->nullable();
			$table->dateTime('fe_entrada');
			$table->dateTime('fe_salida')->nullable();
			$table->integer('id_status');
			$table->dateTime('fe_creado');
			$table->dateTime('fe_actualizado')->nullable();
			$table->integer('id_usuario');

			$table->foreign('id_visitante', 'fk_visita_visitante')->references('id_visitante')->on('visitante');
			$table->foreign('id_tipo_visitante', 'fk_visita_tipo_visitante')->references('id_tipo_visitante')->on('tipo_visitante');
			$table->foreign('id_empresa', 	'fk_visita_empresa')->references('id_empresa')->on('empresa');
			$table->foreign('id_motivo', 	'fk_visita_motivo')->references('id_motivo')->on('motivo');
			$table->foreign('id_status', 	'fk_visita_status')->references('id_status')->on('status');
			$table->foreign('id_usuario', 	'fk_bitacora_usuario')->references('id_usuario')->on('usuario');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('visita');
	}

}
