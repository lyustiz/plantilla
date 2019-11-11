<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoFamiliarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.grupo_familiar', function (Blueprint $table) {
            $table->increments('pk_id_grupo_familiar');
            $table->integer('fk_id_empleado');
            $table->integer('fk_id_familiar');
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
        Schema::dropIfExists('general.grupo_familiar');
    }
}
