<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgrocontLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrocont__lots', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('status')->default(0)->unsigned();
            $table->integer('area')->default(0)->unsigned();
            $table->integer('slope')->default(0)->unsigned();//inclinacion de lote
            $table->integer('texture')->default(0)->unsigned();//testura del suelo ()
            $table->integer('thickness')->default(0)->unsigned();//espesor de tierra
            $table->integer('land_id')->unsigned();
            $table->foreign('land_id')->references('id')->on('agrocont__lands')->onDelete('restrict');

            // Your fields
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agrocont__lots', function (Blueprint $table) {
            $table->dropForeign(['land_id']);
        });
        Schema::dropIfExists('agrocont__lots');
    }
}
