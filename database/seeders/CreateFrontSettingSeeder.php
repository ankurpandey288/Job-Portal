<?php

namespace Database\Seeders;

use App\Models\FrontSetting;
use Illuminate\Database\Seeder;

class CreateFrontSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontSetting::create(['key' => 'featured_jobs_price', 'value' => 0]);
        FrontSetting::create(['key' => 'featured_jobs_days', 'value' => 10]);
        FrontSetting::create(['key' => 'featured_jobs_quota', 'value' => 10]);
        FrontSetting::create(['key' => 'featured_companies_price', 'value' => 0]);
        FrontSetting::create(['key' => 'featured_companies_days', 'value' => 10]);
        FrontSetting::create(['key' => 'featured_companies_quota', 'value' => 10]);
        FrontSetting::create(['key' => 'featured_jobs_enable', 'value' => false]);
        FrontSetting::create(['key' => 'featured_companies_enable', 'value' => false]);
    }
}
