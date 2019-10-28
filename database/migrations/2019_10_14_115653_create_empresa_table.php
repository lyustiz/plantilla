<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->bigIncrements('id_empresa');
            $table->string('nb_empresa', 100)->unique();;
            $table->string('tx_rif', 15);
            $table->string('tx_direccion', 300)->nullable();
            $table->string('tx_telefono', 100)->nullable();
            $table->string('tx_contacto', 80)->nullable();
            $table->string('tx_correo', 50)->nullable();
            $table->integer('id_tipo_empresa')->nullable();
            $table->integer('id_pais');
            $table->integer('id_region1');
            $table->integer('id_region2');
            $table->integer('id_region3');
            $table->integer('id_status');
            $table->string('tx_observaciones', 200)->nullable();
            $table->date('fe_creado');
            $table->date('fe_actualizado');
            $table->integer('id_usuario');
            $table->integer('id_empresa_ppal');

            $table->foreign('id_status', 	'fk_empresa_status')->references('id_status')->on('status');
			$table->foreign('id_usuario', 	'fk_empresa_usuario')->references('id_usuario')->on('usuario');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
