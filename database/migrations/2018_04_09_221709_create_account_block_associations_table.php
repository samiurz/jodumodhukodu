<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountBlockAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_block_associations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id');
            $table->integer('block_id');
            $table->integer('block_stat_id');
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
        Schema::dropIfExists('account_block_associations');
    }
}
