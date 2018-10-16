<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgrocontCropsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrocont__crops_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('name');
            $table->text('description');
            $table->integer('crop_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['crop_id', 'locale']);
            $table->foreign('crop_id')->references('id')->on('agrocont__crops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agrocont__crops_translations', function (Blueprint $table) {
            $table->dropForeign(['crop_id']);
        });
        Schema::dropIfExists('agrocont__crops_translations');
    }
}
