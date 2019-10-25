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
			$table->integer('id_visitante')->nullable();
			$table->integer('id_tipo_visitante')->nullable();
			$table->integer('nu_ced_empleado')->nullable();
			$table->integer('id_empresa')->nullable();
			$table->text('tx_cargo')->nullable();
			$table->integer('id_motivo')->nullable();
			$table->string('tx_observaciones', 2000)->nullable();
			$table->decimal('nu_carnet', 5, 0)->nullable();
			$table->dateTime('fe_entrada')->nullable();
			$table->dateTime('fe_salida')->nullable();
			$table->integer('id_status')->required();
			$table->dateTime('fe_creado')->nullable();
			$table->dateTime('fe_actualizado')->nullable();
			$table->integer('id_usuario')->nullable();

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
