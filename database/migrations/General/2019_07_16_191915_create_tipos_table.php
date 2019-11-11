<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.tipos', function (Blueprint $table) {
            $table->increments('pk_id_tipo');
            $table->string('tx_sistema',15);
            $table->text('tx_grupo')->comment('Grupo del sistema al que pertenece');
            $table->text('tx_des_grupo')->comment('Descripcion del grupo');
            $table->string('co_tipo', 6)->comment('Codigo unico')->unique();
            $table->text('tx_descripcion');
            $table->string('tx_alias',20);
            $table->string('tx_siglas', 3);
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
        Schema::dropIfExists('general.tipos');
    }
}
