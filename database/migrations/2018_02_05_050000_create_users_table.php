<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
			$table->string('nombres', 100);
			$table->string('paterno', 50);
			$table->string('materno', 50);
			$table->string('cuenta');
			$table->string('password');
			$table->rememberToken();
			$table->boolean('jefe')->nullable();
			$table->string('imagen', 255)->nullable();
			$table->unsignedInteger('oficina_id');

			// SoftDelete
			$table->softDeletes();

			// Relation
			$table->foreign('oficina_id')->references('id')->on('oficinas')
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
        Schema::dropIfExists('notificaciones');
        Schema::dropIfExists('users');
    }
}
