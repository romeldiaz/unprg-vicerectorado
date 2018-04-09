<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date');
            $table->string('type', 255);
            $table->string('action', 255);
            $table->text('title');
            $table->integer('from');
            $table->unsignedInteger('to');
            $table->boolean('checked');
            $table->timestamp('checked_date')->nullable();
            $table->text('detail');
            //$table->timestamps();
            $table->softDeletes();

            $table->foreign('to')->references('id')->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('from')->references('id')->on('users')
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
    }
}
