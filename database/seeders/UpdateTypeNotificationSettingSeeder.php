<?php

namespace Database\Seeders;

use App\Models\NotificationSetting;
use Illuminate\Database\Seeder;

/**
 * Class UpdateTypeNotificationSettingSeeder
 */
class UpdateTypeNotificationSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NotificationSetting::whereIn('key', [
            'JOB_APPLICATION_SUBMITTED', 'MARK_JOB_FEATURED', 'CANDIDATE_SELECTED_FOR_JOB',
            'CANDIDATE_REJECTED_FOR_JOB', 'CANDIDATE_SHORTLISTED_FOR_JOB', 'NEW_CANDIDATE_REGISTERED', 'FOLLOW_COMPANY',
            'FOLLOW_JOB', 'JOB_ALERT',
        ])->update(['type' => 'candidate']);

        NotificationSetting::whereIn('key', [
            'MARK_COMPANY_FEATURED', 'NEW_EMPLOYER_REGISTERED', 'EMPLOYER_PURCHASE_PLAN',
        ])->update(['type' => 'employee']);
    }
}
