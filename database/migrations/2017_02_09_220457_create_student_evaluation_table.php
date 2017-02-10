<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentEvaluationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_evaluation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grade');
            $table->integer('evaluation_id')->unsigned();
            $table->integer('student_id')->unsigned();

            $table->foreign('evaluation_id')->references('id')->on('evaluations')->onDelete('restrict');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_evaluation', function (Blueprint $table) {
            Schema::dropIfExists('student_evaluation');
        });
    }
}
