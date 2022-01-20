<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('unique_id');
            $table->string('father_name')->nullable();
            $table->unsignedInteger('marital_status_id')->nullable();
            $table->string('nationality')->nullable();
            $table->string('national_id_card')->nullable();
            $table->integer('experience')->nullable();
            $table->unsignedInteger('career_level_id')->nullable();
            $table->unsignedInteger('industry_id')->nullable();
            $table->unsignedInteger('functional_area_id')->nullable();
            $table->double('current_salary')->nullable();
            $table->double('expected_salary')->nullable();
            $table->string('salary_currency')->nullable();
            $table->text('address')->nullable();
            $table->boolean('immediate_available')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('marital_status_id')->references('id')->on('marital_status')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('career_level_id')->references('id')->on('career_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('functional_area_id')->references('id')->on('functional_areas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('industry_id')->references('id')->on('industries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('candidates');
    }
}
