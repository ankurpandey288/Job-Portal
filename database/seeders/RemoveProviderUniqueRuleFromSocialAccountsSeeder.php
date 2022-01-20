<?php

namespace Database\Seeders;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Class RemoveProviderUniqueRuleFromSocialAccountsSeeder
 */
class RemoveProviderUniqueRuleFromSocialAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
