<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_evaluations', function(Blueprint $table){
            $table->increments('id');
            $table->integer('evaluation_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->float('grade');

            $table->foreign('evaluation_id')->references('id')->on('evaluations')->onDelete('restrict');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('student_evaluations');
    }
}
