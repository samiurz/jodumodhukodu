<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpareTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spare_types', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('company_id');
            $table->string('type');
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
        Schema::dropIfExists('spare_types');
    }
}
