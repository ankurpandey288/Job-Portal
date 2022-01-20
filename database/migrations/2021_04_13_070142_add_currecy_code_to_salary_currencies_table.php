<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrecyCodeToSalaryCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salary_currencies', function (Blueprint $table) {
            $table->string('currency_code')->after('currency_icon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('salary_currencies', 'currency_code')) {
            Schema::table('salary_currencies', function (Blueprint $table) {
                $table->dropColumn('currency_code');
            });
        }
    }
}
