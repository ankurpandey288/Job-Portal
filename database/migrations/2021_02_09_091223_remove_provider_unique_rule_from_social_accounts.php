<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveProviderUniqueRuleFromSocialAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('social_accounts', function (Blueprint $table) {
            $sa = Schema::getConnection()->getDoctrineSchemaManager();
            $indexesFound = $sa->listTableIndexes('social_accounts');

            if (array_key_exists('social_accounts_provider_unique', $indexesFound)) {
                $table->dropUnique(['provider']);
            }
        });
    }
}
