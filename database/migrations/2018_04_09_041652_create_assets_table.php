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
            $table->integer('label_value');
            $table->string('description');
            $table->integer('manufacturer_id');
            $table->integer('quality_id');
            $table->string('cost');
            $table->integer('asset_location_id');
            $table->string('image');
            $table->integer('asset_status_id');
            $table->integer('minimum_stock');
            $table->integer('current_stock');
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
        Schema::dropIfExists('assets');
    }
}
