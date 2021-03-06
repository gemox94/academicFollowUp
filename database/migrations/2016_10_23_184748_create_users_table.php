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
          $table->rememberToken();
          $table->timestamps();
          $table->integer('role_id')->unsigned();
          $table->string('name');
          $table->string('lastname');
          $table->string('email')->unique();
          $table->string('password');
          $table->string('key');
          $table->string('cubicle')->nullable();
          $table->string('student_program')->nullable();
          $table->string('phone');

          $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
