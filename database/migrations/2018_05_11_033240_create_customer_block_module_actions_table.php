<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerBlockModuleActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_block_module_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contact_id');
            $table->integer('block_id');
            $table->integer('module_id');
            $table->integer('activity_id');
            $table->string('comments');
            $table->integer('created_by');
            $table->integer('update_by');
            $table->tinyInteger('is_enabled')->default(0);
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
        Schema::dropIfExists('customer_block_module_actions');
    }
}
