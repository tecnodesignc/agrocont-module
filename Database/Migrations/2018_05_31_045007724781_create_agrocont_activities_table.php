<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgrocontActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrocont__activities', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields
            $table->timestamp('startdate')->nullable();
            $table->timestamp('enddate')->nullable();
            $table->integer('term')->default(0)->unsigned();
            $table->integer('status')->default(0)->unsigned();
            $table->integer('crop_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('crop_id')->references('id')->on('agrocont__crops')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');

            $table->text('options')->default('')->nullable();
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
        Schema::dropIfExists('agrocont__activities');
    }
}
