<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgrocontLotsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrocont__lots_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('name');
            $table->integer('lots_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['lots_id', 'locale']);
            $table->foreign('lots_id')->references('id')->on('agrocont__lots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agrocont__lots_translations', function (Blueprint $table) {
            $table->dropForeign(['lots_id']);
        });
        Schema::dropIfExists('agrocont__lots_translations');
    }
}
