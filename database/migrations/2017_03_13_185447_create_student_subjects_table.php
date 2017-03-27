<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subjects', function(Blueprint $table){
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->float('final_grade')->nullable();

            $table->foreign('student_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('student_subjects');
    }
}
