<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->increments('id');
			$table->string('descripcion', 150);
			$table->decimal('monto', 10, 2);
			$table->string('numero', 20)->nullable();
			$table->date('fecha');
			$table->enum('tipo', ['B', 'S']);
			
			// SoftDelete
			$table->softDeletes();

			$table->unsignedInteger('meta_id');
			$table->unsignedInteger('tipo_documento_id');


			// Relation
			$table->foreign('meta_id')->references('id')->on('metas')
				->onDelete('cascade')
				->onUpdate('cascade');
			
			$table->foreign('tipo_documento_id')->references('id')->on('tipo_documentos')
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
        Schema::dropIfExists('gastos');
    }
}
