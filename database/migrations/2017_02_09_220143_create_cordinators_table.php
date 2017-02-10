<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCordinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cordinators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('password');
            $table->integer('teacher_id')->unsigned();

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cordinators', function (Blueprint $table) {
            Schema::dropIfExists('cordinators');
        });
    }
}
