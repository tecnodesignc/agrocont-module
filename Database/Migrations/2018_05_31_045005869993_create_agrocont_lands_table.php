<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgrocontLandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrocont__lands', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unisigne();
            // Your fields
            $table->text('address')->nullable();
            $table->text('options')->default('')->nullable();
            $table->integer('type')->default(0)->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');


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
        Schema::dropIfExists('agrocont__lands');
    }
}
