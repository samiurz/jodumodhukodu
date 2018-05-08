<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('asset_model_id');
            $table->string('name');
            $table->string('serial');
            $table->integer('label_id');
            $table->string('label_value');
            $table->string('description');
            $table->integer('manufacturer_id');
            $table->integer('quality');
            $table->string('cost');
            $table->string('status');
            $table->string('image');
            $table->string('minimum_stock');
            $table->string('current_stock');
            $table->string('comments');
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
        Schema::dropIfExists('assets');
    }
}
