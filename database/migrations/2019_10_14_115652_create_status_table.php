<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status', function(Blueprint $table)
		{
			$table->integer('id_status', true);
			$table->string('nb_status', 30)->unique();
            $table->string('in_grupo_status', 3)->comment('indicador de grupo de status');
            $table->string('nb_grupo_status', 30);
            $table->string('nb_status2', 30)->nullable();
            $table->integer('nu_orden');
            $table->integer('nu_orden2');
			$table->date('fe_creado');
			$table->date('fe_actualizado')->nullable();;
			$table->date('id_usuario');
			
		});
               
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('status');
    }
}
