<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.empleados', function (Blueprint $table) {
            $table->integer('pk_id_empleado')->primary();
            $table->string('co_empleado');
            $table->string('nb_empleado');
            $table->date('fe_nacimiento');
            $table->integer('nu_nomina')->unique();
            $table->text('tx_direccion');
            #$table->integer('fk_id_ubicacion')->nullable(); zona postal
            $table->integer('fk_id_genero');
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
        Schema::dropIfExists('general.empleados');
    }
}
