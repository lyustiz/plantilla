<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTramiteNotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fas.tramite_nota', function (Blueprint $table) {
            $table->increments('pk_id_tramite_nota');
            $table->integer('fk_id_tramite');
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
        Schema::dropIfExists('fas.tramite_nota');
    }
}
