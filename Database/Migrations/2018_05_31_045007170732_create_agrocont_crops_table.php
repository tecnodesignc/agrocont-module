<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgrocontCropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrocont__crops', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields
            $table->integer('area');
            $table->integer('status')->default(0)->unsigned();
            $table->integer('type')->default(0)->unsigned();
            $table->timestamp('startdate')->nullable();
            $table->timestamp('enddate')->nullable();
            $table->text('options')->default('')->nullable();
            $table->integer('lot_id')->unsigned();
            $table->foreign('lot_id')->references('id')->on('agrocont__lots')->onDelete('restrict');



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
        Schema::dropIfExists('agrocont__crops');
    }
}
