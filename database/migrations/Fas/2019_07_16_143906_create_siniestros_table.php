<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiniestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fas.siniestros', function (Blueprint $table) {
            $table->integer('fk_id_institucion');
            $table->integer('pk_id_siniestro')->primary();
            $table->string('co_siniestro');
            $table->integer('fk_id_proveedor');
            $table->integer('fk_id_cobertura');
            $table->integer('fk_id_patologia');
            $table->integer('fk_id_asegurado');
            $table->text('tx_observacion');
            $table->date('fe_notificacion');
            $table->date('fe_ocurrencia');
            $table->date('fe_constitucion');
            $table->integer('fk_id_estatu');
            $table->boolean('bo_estatu');
            $table->integer('fk_id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fas.siniestros');
    }
}
