<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.familiares', function (Blueprint $table) {
            $table->integer('pk_id_familiar')->primary();
            $table->string('co_familiar');
            $table->string('nb_familiar');
            $table->date('fe_nacimiento');
            $table->string('fk_tp_parentesco');
            #$table->integer('fk_id_ubicacion')->nullable(); zona postal
            $table->integer('fk_id_estatu');
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
        Schema::dropIfExists('general.familiares');
    }
}
