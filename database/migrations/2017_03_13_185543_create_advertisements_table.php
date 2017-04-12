<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->integer('role_id')->unsigned();
            $table->integer('subject_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('message');

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
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
        Schema::drop('advertisements');
    }
}
