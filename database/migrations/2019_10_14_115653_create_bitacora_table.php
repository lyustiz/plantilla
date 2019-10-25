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
			$table->string('co_accion', 3)->nullable();
			$table->string('tx_tabla')->nullable();
			$table->integer('in_id_tabla');
			$table->string('tx_old_valor', 4000)->nullable();
			$table->string('tx_new_valor', 4000)->nullable();
			$table->dateTime('fe_accion')->nullable();
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
