<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 255);
            $table->string('estado', 255);
            $table->string('observacion', 255)->nullable();
            $table->date('fecha_completado')->nullable();
            //$table->timestamps();

            $table->softDeletes();
      			$table->unsignedInteger('meta_id');

            $table->foreign('meta_id')->references('id')->on('metas')
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
    }
}
