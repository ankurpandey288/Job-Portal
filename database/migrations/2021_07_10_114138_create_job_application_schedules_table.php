<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_application_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('job_application_id');
            $table->unsignedBigInteger('stage_id');
            $table->string('time');
            $table->string('date');
            $table->text('notes')->nullable();
            $table->integer('status')->nullable();
            $table->integer('batch')->nullable();
            $table->text('rejected_slot_notes')->nullable();
            $table->text('employer_cancel_slot_notes')->nullable();
            $table->timestamps();

            $table->foreign('job_application_id')->references('id')->on('job_applications')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('stage_id')->references('id')->on('job_stages')
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
        Schema::dropIfExists('job_application_schedules');
    }
}
