<?php

namespace Database\Seeders;

use App\Models\FrontSetting;
use Illuminate\Database\Seeder;

class AddLatestJobsEnableInFrontSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontSetting::create(['key' => 'latest_jobs_enable', 'value' => false]);
    }
}
