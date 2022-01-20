<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_educations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('candidate_id');
            $table->unsignedInteger('degree_level_id');
            $table->string('degree_title');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('institute');
            $table->string('result');
            $table->integer('year');
            $table->timestamps();

            $table->foreign('candidate_id')->references('id')->on('candidates')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('degree_level_id')->references('id')->on('required_degree_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('state_id')->references('id')->on('states')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('set null')
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
        Schema::dropIfExists('candidate_education');
    }
}
