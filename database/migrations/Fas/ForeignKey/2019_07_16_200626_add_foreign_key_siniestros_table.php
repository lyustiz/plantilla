<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeySiniestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fas.siniestros', function (Blueprint $table) {
            $table->foreign('fk_id_institucion')->references('pk_id_institucion')   ->on('general.institucion');
            $table->foreign('fk_id_proveedor')  ->references('pk_id_proveedor')     ->on('general.proveedor');
            $table->foreign('fk_id_cobertura')  ->references('pk_id_tipo')          ->on('general.tipos');
            $table->foreign('fk_id_patologia')  ->references('pk_id_patologia')     ->on('fas.patologias');
            $table->foreign('fk_id_asegurado')  ->references('pk_id_grupo_familiar')->on('general.grupo_familiar');
            $table->foreign('fk_id_estatu')     ->references('pk_id_tipo')          ->on('general.tipos');
            $table->foreign('fk_id_usuario')    ->references('pk_id_empleado')      ->on('general.empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fas.siniestros', function (Blueprint $table) {
            $table->dropForeign(['fk_id_institucion']);
            $table->dropForeign(['fk_id_proveedor']);
            $table->dropForeign(['fk_id_cobertura']);
            $table->dropForeign(['fk_id_patologia']);
            $table->dropForeign(['fk_id_asegurado']);
            $table->dropForeing(['fk_id_estatu']);
            $table->dropForeing(['fk_id_usuario']);
        });
    }
}
