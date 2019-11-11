<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorreosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.correos', function (Blueprint $table) {
            $table->increments('pk_id_correo');
            $table->integer('fk_id_grupo');
            $table->integer('fk_id_usuario');
            $table->string('tx_correo',100);
            $table->string('fk_tp_correo');
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
        Schema::dropIfExists('general.correos');
    }
}
