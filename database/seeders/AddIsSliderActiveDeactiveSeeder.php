<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Class AddIsSliderActiveDeactive
 */
class AddIsSliderActiveDeactiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exist = Setting::where('key', 'is_slider_active')->exists();
        if (! $exist) {
            Setting::create(['key' => 'is_slider_active', 'value' => '1']);
        }
    }
}
