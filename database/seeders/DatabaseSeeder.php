<?php

namespace Database\Seeders;

use Database\Seeders\AddEnableGoogleRecaptchaSeeder;
use Database\Seeders\AddIsActiveInSettingSeeder;
use Database\Seeders\AddIsFullSliderSettingSeeder;
use Database\Seeders\AddIsSliderActiveDeactiveSeeder;
use Database\Seeders\AddLatestJobsEnableInFrontSettingSeeder;
use Database\Seeders\AddRecordNotificationSetting;
use Database\Seeders\AddRegionCodeInSettingsSeeder;
use Database\Seeders\CreateDefaultCareerLevelSeeder;
use Database\Seeders\CreateDefaultCurrencySeeder;
use Database\Seeders\CreateDefaultDegreeLevelSeeder;
use Database\Seeders\CreateDefaultFunctionalAreaSeeder;
use Database\Seeders\CreateDefaultIndustriesSeeder;
use Database\Seeders\CreateDefaultJobShiftSeeder;
use Database\Seeders\CreateDefaultJobTypeSeeder;
use Database\Seeders\CreateDefaultOwnerShipTypeSeeder;
use Database\Seeders\CreateDefaultPostCategorySeeder;
use Database\Seeders\CreateDefaultSalaryPeriodSeeder;
use Database\Seeders\CreateFrontSettingSeeder;
use Database\Seeders\CreateNotificationSettingSeeder;
use Database\Seeders\CurrencySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateDefaultCurrencySeeder::class);
        $this->call(DefaultTrialPlanSeeder::class);
        $this->call(MakeCountriesSeeder::class);
        $this->call(DefaultUserSeeder::class);
        $this->call(DefaultRoleSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(DefaultCompanySizeSeeder::class);
        $this->call(MaritalStatusTableSeeder::class);
        $this->call(CreateDefaultIndustriesSeeder::class);
        $this->call(CreateDefaultOwnerShipTypeSeeder::class);
        $this->call(CreateDefaultJobTypeSeeder::class);
        $this->call(CreateDefaultCareerLevelSeeder::class);
        $this->call(CreateDefaultJobShiftSeeder::class);
        $this->call(CreateDefaultSalaryPeriodSeeder::class);
        $this->call(CreateDefaultFunctionalAreaSeeder::class);
        $this->call(CreateDefaultDegreeLevelSeeder::class);
        $this->call(JobCategorySeeder::class);
        $this->call(SkillTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(CreateDefaultPostCategorySeeder::class);
        $this->call(CreateFrontSettingSeeder::class);
        $this->call(UpdateSettingsTableSeeder::class);
        $this->call(AddRegionCodeInSettingsSeeder::class);
        $this->call(AddIsActiveInSettingSeeder::class);
        $this->call(AddLatestJobsEnableInFrontSettingSeeder::class);
        $this->call(RenameIsActiveToSlierIsActiveInSettingSeeder::class);
        $this->call(CreateNotificationSettingSeeder::class);
        $this->call(NotificationSettingModuleSeeder::class);
        $this->call(UpdateTypeNotificationSettingSeeder::class);
        $this->call(AddIsFullSliderSettingSeeder::class);
        $this->call(AddIsSliderActiveDeactiveSeeder::class);
        $this->call(PrivacyPolicySeeder::class);
        $this->call(AddRecordNotificationSetting::class);
        $this->call(UpdateNotificationSettingAdminTypeSeeder::class);
        $this->call(AddEnableGoogleRecaptchaSeeder::class);
        $this->call(RemoveProviderUniqueRuleFromSocialAccountsSeeder::class);
        $this->call(FrontSettingAdvertiseImageSeeder::class);
        $this->call(EmailTemplateSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(FooterLogoSeeder::class);
    }
}
