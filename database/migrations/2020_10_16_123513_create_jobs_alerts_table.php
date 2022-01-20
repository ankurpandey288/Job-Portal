<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_alerts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('candidate_id');
            $table->unsignedInteger('job_type_id');
            $table->timestamps();
            $table->foreign('candidate_id')->references('id')->on('candidates')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('job_type_id')->references('id')->on('job_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs_alerts');
    }
}
