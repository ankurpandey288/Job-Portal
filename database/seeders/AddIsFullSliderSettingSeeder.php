<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Class AddIsFullSliderSettingSeeder
 */
class AddIsFullSliderSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exist = Setting::where('key', 'is_full_slider')->exists();
        if (! $exist) {
            Setting::create(['key' => 'is_full_slider', 'value' => '0']);
        }
    }
}
