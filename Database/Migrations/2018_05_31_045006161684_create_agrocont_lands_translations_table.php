<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgrocontLandsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrocont__lands_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('name');
            $table->text('description');
            $table->integer('land_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['land_id', 'locale']);
            $table->foreign('land_id')->references('id')->on('agrocont__lands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agrocont__lands_translations', function (Blueprint $table) {
            $table->dropForeign(['land_id']);
        });
        Schema::dropIfExists('agrocont__lands_translations');
    }
}
