<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class RenameIsActiveToSlierIsActiveInSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isActive = Setting::where(['key' => 'is_active'])->first();
        $exist = Setting::where('key', 'slider_is_active')->exists();
        if ($isActive && ! $exist) {
            $isActive->update(['key' => 'slider_is_active']);
        } elseif (! $exist) {
            Setting::create(['key' => 'slider_is_active', 'value' => 1]);
        }
    }
}
