<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_id')->unsigned();
            $table->unsignedInteger('tag_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs_tag');
    }
}
