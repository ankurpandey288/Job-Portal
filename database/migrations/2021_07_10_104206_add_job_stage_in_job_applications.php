<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobStageInJobApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('job_stage_id')->nullable()->after('notes');

            $table->foreign('job_stage_id')->references('id')->on('job_stages')
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
        if (Schema::hasColumn('job_applications', 'job_stage_id')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->dropColumn('job_stage_id');
            });
        }
    }
}
