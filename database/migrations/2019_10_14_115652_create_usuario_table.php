<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario', function(Blueprint $table)
		{
			$table->integer('id_usuario', true);
			$table->string('nb_usuario', 200)->unique();
			$table->string('password', 32);
			$table->string('tx_correo', 300);
			$table->string('nu_cedula', 12);
			$table->string('nb_p_nombre', 30);
			$table->string('nb_s_nombre', 30)->nullable();
			$table->string('nb_p_apellido', 30);
			$table->string('nb_s_apellido', 30)->nullable();
			$table->string('tx_nacionalidad', 1)->nullable();
			$table->string('tx_rif', 12)->nullable();
			$table->string('tx_telefono', 100)->nullable();
			$table->integer('id_status');
			$table->date('fe_creado');
			$table->date('fe_actualizado')->nullable();
			$table->date('id_usuario_c');

			$table->foreign('id_status', 'fk_usuario_status')->references('id_status')->on('status');
			

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario');
	}

}
