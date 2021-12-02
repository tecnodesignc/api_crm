<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsObjectTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects__object_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('object_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['object_id', 'locale']);
            $table->foreign('object_id')->references('id')->on('projects__objects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects__object_translations', function (Blueprint $table) {
            $table->dropForeign(['object_id']);
        });
        Schema::dropIfExists('projects__object_translations');
    }
}
