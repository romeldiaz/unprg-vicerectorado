<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nombre', 255);
			$table->date('fecha_inicio_esperada');
			$table->date('fecha_inicio')->nullable();
			$table->date('fecha_fin_esperada');
			$table->date('fecha_fin')->nullable();
			$table->string('producto', 255);
			$table->decimal('presupuesto', 10, 2);
			$table->enum('estado', ['I', 'E', 'F'])->default('I');
			// I: Iniciado - E: En Proceso - F: Finalizado

			// SoftDelete
			$table->softDeletes();

			$table->unsignedInteger('actividad_id');
			$table->unsignedInteger('creador_id');
			$table->unsignedInteger('monitor_id');

			// Relation
			$table->foreign('actividad_id')->references('id')->on('actividades')
				->onDelete('cascade')
				->onUpdate('cascade');
			$table->foreign('creador_id')->references('id')->on('users')
				->onDelete('cascade')
				->onUpdate('cascade');
			$table->foreign('monitor_id')->references('id')->on('users')
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
        Schema::dropIfExists('requisitos');
        Schema::dropIfExists('monitoreos');
        Schema::dropIfExists('metas');
    }
}
