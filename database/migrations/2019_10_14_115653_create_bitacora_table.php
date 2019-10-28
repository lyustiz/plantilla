<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBitacoraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bitacora', function(Blueprint $table)
		{
			$table->integer('id_bitacora', true);
			$table->string('co_accion', 3);
			$table->string('tx_tabla');
			$table->integer('in_id_tabla');
			$table->string('tx_old_valor', 500)->nullable();
			$table->string('tx_new_valor', 500)->nullable();
			$table->dateTime('fe_accion');
			$table->integer('id_usuario');

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
		Schema::drop('bitacora');
	}

}
