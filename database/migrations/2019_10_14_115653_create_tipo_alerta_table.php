<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoAlertaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipo_alerta', function(Blueprint $table)
		{
			$table->integer('id_tipo_alerta', true);
			$table->string('nb_tipo_alerta', 50)->nullable();
			$table->decimal('nu_nivel_alerta', 1, 0)->nullable();
			$table->string('tx_accion', 200)->nullable();
			$table->string('tx_imagen')->nullable();
			$table->integer('id_status')->nullable();
			$table->dateTime('fe_creado')->nullable();
			$table->dateTime('fe_actualizado')->nullable();
			$table->integer('id_usuario')->nullable();

			$table->foreign('id_status', 'fk_tipo_alerta_status')->references('id_status')->on('status');
			$table->foreign('id_usuario', 'fk_tipo_alerta_usuario')->references('id_usuario')->on('usuario');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipo_alerta');
	}

}
