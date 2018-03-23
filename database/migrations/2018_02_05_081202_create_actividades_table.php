<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nombre', 150);
			$table->string('estado', 20)->nullable();

			$table->date('fecha_creacion')->default('now()');
			$table->decimal('presupuesto', 10, 2)->nullable();
			$table->date('fecha_inicio')->nullable();
			$table->date('fecha_fin_esperada')->nullable();
			$table->date('fecha_fin')->nullable();
			$table->string('numero_resolucion', 30)->nullable();
			$table->date('fecha_resolucion')->nullable();
			// $table->string('numero_acta', 30)->nullable();
			$table->date('fecha_acta')->nullable();
			$table->string('descripcion_acta', 255)->nullable();
			$table->unsignedInteger('creador_id');
			$table->unsignedInteger('monitor_id');
			
			// SoftDelete
			$table->softDeletes();

			//Relation
			$table->foreign('creador_id')->references('id')->on('users')
				->onDelete('cascade')
				->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades');
    }
}