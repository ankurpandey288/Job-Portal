<?php

namespace Database\Seeders;

use App\Models\Setting;
use Database\Seeders\SettingsTableSeeder;
use Illuminate\Database\Seeder;

class UpdateSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create(['key' => 'company_url', 'value' => 'www.infyom.com']);
    }
}
