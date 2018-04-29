<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerBlockModuleActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_block_module_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contact_id');
            $table->integer('customer_block_id');
            $table->integer('module_id');
            $table->integer('activity_id');
            $table->integer('update_by');
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
        Schema::dropIfExists('customer_block_module_activities');
    }
}
