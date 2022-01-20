<?php

namespace Database\Seeders;

use App\Models\NotificationSetting;
use Illuminate\Database\Seeder;

class CreateNotificationSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NotificationSetting::create(['key' => 'JOB_APPLICATION_SUBMITTED', 'value' => true]);
        NotificationSetting::create(['key' => 'MARK_JOB_FEATURED', 'value' => true]);
        NotificationSetting::create(['key' => 'MARK_COMPANY_FEATURED', 'value' => true]);
        NotificationSetting::create(['key' => 'CANDIDATE_SELECTED_FOR_JOB', 'value' => true]);
        NotificationSetting::create(['key' => 'CANDIDATE_REJECTED_FOR_JOB', 'value' => true]);
        NotificationSetting::create(['key' => 'CANDIDATE_SHORTLISTED_FOR_JOB', 'value' => true]);
        NotificationSetting::create(['key' => 'NEW_EMPLOYER_REGISTERED', 'value' => true]);
        NotificationSetting::create(['key' => 'NEW_CANDIDATE_REGISTERED', 'value' => true]);
        NotificationSetting::create(['key' => 'EMPLOYER_PURCHASE_PLAN', 'value' => true]);
        NotificationSetting::create(['key' => 'FOLLOW_COMPANY', 'value' => true]);
        NotificationSetting::create(['key' => 'FOLLOW_JOB', 'value' => true]);
    }
}
