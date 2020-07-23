<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToDosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('creator_user_id');
            $table->unsignedBigInteger('target_user_id')->nullable();
            $table->unsignedBigInteger('schedule_id');
            $table->boolean('delegated')->default(false);
            $table->string('title');
            $table->text('description');
            $table->timestamps();
            $table->foreign('creator_user_id')
                ->references('id')
                ->on('users');
            $table->foreign('target_user_id')
                ->references('id')
                ->on('users');
            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
