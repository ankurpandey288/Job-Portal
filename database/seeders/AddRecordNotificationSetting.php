<?php

namespace Database\Seeders;

use App\Models\NotificationSetting;
use Illuminate\Database\Seeder;

class AddRecordNotificationSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $existCompanyFeatured = NotificationSetting::where('key', 'MARK_COMPANY_FEATURED_ADMIN')->exists();
        if (! $existCompanyFeatured) {
            NotificationSetting::create(['key' => 'MARK_COMPANY_FEATURED_ADMIN', 'type' => 'admin', 'value' => true]);
        }
        $existJobFeatured = NotificationSetting::where('key', 'MARK_JOB_FEATURED_ADMIN')->exists();
        if (! $existJobFeatured) {
            NotificationSetting::create(['key' => 'MARK_JOB_FEATURED_ADMIN', 'type' => 'admin', 'value' => true]);
        }
    }
}
