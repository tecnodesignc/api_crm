<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsActivityTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects__activity_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('activity_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['activity_id', 'locale']);
            $table->foreign('activity_id')->references('id')->on('projects__activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects__activity_translations', function (Blueprint $table) {
            $table->dropForeign(['activity_id']);
        });
        Schema::dropIfExists('projects__activity_translations');
    }
}
