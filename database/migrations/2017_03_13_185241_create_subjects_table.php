<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->enum('status', ['disabled'])->nullable();
            $table->integer('teacher_id')->unsigned();
            $table->string('name');
            $table->string('nrc');
            $table->string('schedule_json');
            $table->string('key');
            $table->string('section');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subjects');
    }
}
