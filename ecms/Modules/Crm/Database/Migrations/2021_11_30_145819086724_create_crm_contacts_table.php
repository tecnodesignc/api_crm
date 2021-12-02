<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm__contacts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('salutation')->default('Sr');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('other_phone')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zip')->nullable();
            $table->string('reporting_to')->nullable();
            $table->boolean('approved')->default(1);
            $table->string('lead_source')->nullable();
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
            $table->text('description')->nullable();
            $table->string('department')->nullable();
            $table->string('assistant')->nullable();
            $table->string('asst_phone')->nullable();
            $table->integer('modified_by')->unsigned();
            $table->foreign('modified_by')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
            $table->string('skype_id')->nullable();
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('crm__accounts')->onDelete('cascade');
            $table->string('unsubscribed_mode')->nullable();
            $table->timestamp('unsubscribed_time')->nullable();
            $table->text('options')->nullable();
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
        Schema::dropIfExists('crm__contacts');
    }
}
