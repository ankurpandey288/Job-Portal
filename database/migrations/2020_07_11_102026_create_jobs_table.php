<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_id');
            $table->string('job_title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->double('salary_from');
            $table->double('salary_to');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('job_category_id');
            $table->unsignedInteger('currency_id');
            $table->unsignedInteger('salary_period_id');
            $table->unsignedInteger('job_type_id');
            $table->unsignedInteger('career_level_id');
            $table->unsignedInteger('functional_area_id');
            $table->unsignedInteger('job_shift_id');
            $table->unsignedInteger('degree_level_id');
            $table->integer('position');
            $table->date('job_expiry_date');
            $table->integer('no_preference');
            $table->boolean('hide_salary');
            $table->boolean('is_freelance');
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('salary_period_id')->references('id')->on('salary_periods')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('salary_currencies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('job_type_id')->references('id')->on('job_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('career_level_id')->references('id')->on('career_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('functional_area_id')->references('id')->on('functional_areas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('job_shift_id')->references('id')->on('job_shifts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('degree_level_id')->references('id')->on('required_degree_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('job_category_id')->references('id')->on('job_categories')
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
        Schema::dropIfExists('jobs');
    }
}
