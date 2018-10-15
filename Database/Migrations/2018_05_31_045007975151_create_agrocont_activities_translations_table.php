<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgrocontActivitiesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrocont__activities_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('title');
            $table->text('description');
            $table->integer('activities_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['activities_id', 'locale']);
            $table->foreign('activities_id')->references('id')->on('agrocont__activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agrocont__activities_translations', function (Blueprint $table) {
            $table->dropForeign(['activities_id']);
        });
        Schema::dropIfExists('agrocont__activities_translations');
    }
}
