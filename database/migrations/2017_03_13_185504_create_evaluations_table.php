<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->integer('subject_id')->unsigned();
            $table->string('name');
            $table->float('percentage');
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
        Schema::drop('evaluations');
    }
}
