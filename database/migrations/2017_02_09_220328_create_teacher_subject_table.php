<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nrc');
            $table->string('schedule_json');
            $table->string('period');
            $table->integer('teacher_id')->unsigned();
            $table->integer('subject_id')->unsigned();

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('restrict');
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
        Schema::table('teacher_subject', function (Blueprint $table) {
            Schema::dropIfExists('teacher_subject');
        });
    }
}
