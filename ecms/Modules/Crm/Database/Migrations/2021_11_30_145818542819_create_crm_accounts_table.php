<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm__accounts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('account_name');
            $table->integer('parent_account')->unsigned()->nullable();
            $table->foreign('parent_account')->references('id')->on('crm__accounts')->onDelete('restrict');
            $table->string('fax')->nullable();
            $table->string('phone')->nullable();
            $table->integer('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
            $table->string('industry')->nullable();
            $table->string('account_site')->nullable();
            $table->string('state')->nullable();
            $table->string('process_flow')->nullable();
            $table->string('billing_street')->nullable();
            $table->string('billing_code')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_street')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_code')->nullable();
            $table->boolean('approved ')->default(true);
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->integer('status')->default(0);
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
            $table->double('annual_revenue',255,3)->nullable();
            $table->string('ownership')->nullable();
            $table->text('description')->nullable();
            $table->string('rating')->nullable();
            $table->string('website')->nullable();
            $table->integer('employees');
            $table->integer('modified_by')->unsigned();
            $table->foreign('modified_by')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
            $table->integer('review')->nullable();
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
        Schema::table('crm__accounts', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['owner_id']);
            $table->dropForeign(['modified_by']);
            $table->dropForeign(['parent_account']);
        });
        Schema::dropIfExists('crm__accounts');
    }
}
