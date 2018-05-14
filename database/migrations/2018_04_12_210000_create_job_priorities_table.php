<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobPrioritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_priorities', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('company_id');
            $table->string('priority');
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
        Schema::dropIfExists('job_priorities');
    }
}
