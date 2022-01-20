<?php

namespace Database\Seeders;

use App\Models\FrontSetting;
use Illuminate\Database\Seeder;

class FrontSettingAdvertiseImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageUrl = 'assets/img/infyom-logo.png';

        FrontSetting::create(['key' => 'advertise_image', 'value' => $imageUrl]);
    }
}
