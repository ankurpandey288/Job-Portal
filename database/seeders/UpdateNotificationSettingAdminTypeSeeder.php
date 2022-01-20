<?php

namespace Database\Seeders;

use App\Models\NotificationSetting;
use Illuminate\Database\Seeder;

/**
 * Class UpdateNotificationSettingAdminTypeSeeder
 */
class UpdateNotificationSettingAdminTypeSeeder extends seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NotificationSetting::whereIn('key', [
            'CANDIDATE_SELECTED_FOR_JOB',
            'CANDIDATE_REJECTED_FOR_JOB',
            'CANDIDATE_SHORTLISTED_FOR_JOB',
            'JOB_ALERT',
        ])->update(['type' => 'candidate']);

        NotificationSetting::whereIn('key', [
            'MARK_JOB_FEATURED',
            'MARK_COMPANY_FEATURED',
            'JOB_APPLICATION_SUBMITTED',
            'FOLLOW_COMPANY',
            'FOLLOW_JOB',
        ])->update(['type' => 'employer']);

        NotificationSetting::whereIn('key', [
            'MARK_COMPANY_FEATURED_ADMIN',
            'MARK_JOB_FEATURED_ADMIN',
            'NEW_EMPLOYER_REGISTERED',
            'NEW_CANDIDATE_REGISTERED',
            'EMPLOYER_PURCHASE_PLAN',
        ])->update(['type' => 'admin']);
    }
}
