<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangesOnColumnsToJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedInteger('career_level_id')->nullable()->change();
            $table->unsignedInteger('job_shift_id')->nullable()->change();
            $table->unsignedInteger('degree_level_id')->nullable()->change();
            $table->unsignedInteger('no_preference')->nullable()->change();
        });
    }
}
