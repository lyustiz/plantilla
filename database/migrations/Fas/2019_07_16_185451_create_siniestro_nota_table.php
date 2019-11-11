<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiniestroNotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fas.siniestro_nota', function (Blueprint $table) {
            $table->increments('pk_id_siniestro_nota');
            $table->integer('fk_id_siniestro');
            $table->integer('fk_id_estatus');
            $table->integer('fk_id_usuario');
            $table->boolean('bo_estatu');
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
        Schema::dropIfExists('fas.siniestro_nota');
    }
}
