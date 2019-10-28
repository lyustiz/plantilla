<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoVisitanteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipo_visitante', function(Blueprint $table)
		{
			$table->integer('id_tipo_visitante', true);
			$table->string('nb_tipo_visitante')->unique();
			$table->integer('id_status');
			$table->dateTime('fe_creado');
			$table->dateTime('fe_actualizado')->nullable();
			$table->integer('id_usuario');

			$table->foreign('id_status', 'fk_tipo_visitante_status')->references('id_status')->on('status');
			$table->foreign('id_usuario', 'fk_bitacora_usuario')->references('id_usuario')->on('usuario');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipo_visitante');
	}

}
