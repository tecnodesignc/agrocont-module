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
            $table->integer('quantity')->default(0)->unsigned();
            $table->integer('unit')->default(0)->unsigned();
            $table->timestamp('startdate')->nullable();
            $table->timestamp('enddate')->nullable();
            $table->text('options')->default('')->nullable();
            $table->integer('lot_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
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
        Schema::table('agrocont__crops', function (Blueprint $table) {
            $table->dropForeign(['lot_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('agrocont__crops');
    }
}
