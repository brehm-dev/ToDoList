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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('default_schedule_id')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->unique()->default('test@test.test');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('ROLE_USER');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('default_schedule_id')
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
        Schema::dropIfExists('users');
    }
}
