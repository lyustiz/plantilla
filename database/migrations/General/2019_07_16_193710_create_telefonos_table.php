<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.telefonos', function (Blueprint $table) {
            $table->increments('pk_id_telefono');
            $table->integer('fk_id_grupo');
            $table->integer('fk_id_usuario');
            $table->integer('nu_telefono');
            $table->string('fk_tp_telefono');
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
        Schema::dropIfExists('general.telefonos');
    }
}
