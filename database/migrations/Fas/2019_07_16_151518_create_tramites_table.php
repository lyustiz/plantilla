<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTramitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fas.tramites', function (Blueprint $table) {
            $table->integer('fk_id_institucion');
            $table->integer('fk_id_siniestro');
            $table->integer('pk_id_tramite')->primary();
            $table->string('co_tramite');
            $table->text('tx_observacion');
            $table->integer('fk_id_ruta'); # ID del Usuario
            $table->integer('fk_id_estatus');
            $table->boolean('bo_estatus');
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
        Schema::dropIfExists('fas.tramites');
    }
}
