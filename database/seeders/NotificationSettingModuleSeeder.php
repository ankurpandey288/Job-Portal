<?php

namespace Database\Seeders;

use App\Models\NotificationSetting;
use Illuminate\Database\Seeder;

class NotificationSettingModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'key'   => 'JOB_ALERT',
                'value' => true,
            ],
        ];
        foreach ($input as $data) {
            $module = NotificationSetting::where('key', $data['key'])->first();
            if ($module) {
                $module->update(['value' => $data['value']]);
            } else {
                NotificationSetting::create($data);
            }
        }
    }
}
