<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class AddRegionCodeInSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phone = Setting::where(['key' => 'phone'])->first();
        $phone->update(['key' => 'phone', 'value' => '70963 36561']);
        Setting::create(['key' => 'region_code', 'value' => '91']);
    }
}
