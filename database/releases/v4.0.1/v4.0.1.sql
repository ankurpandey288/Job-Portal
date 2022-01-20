alter table `notification_settings` add `type` varchar(191) null after `key`;

 update `notification_settings` set `type` = 'candidate', `notification_settings`.`updated_at` = '2020-12-15 09:01:08' where `key` in ('JOB_APPLICATION_SUBMITTED', 'MARK_JOB_FEATURED', 'CANDIDATE_SELECTED_FOR_JOB', 'CANDIDATE_REJECTED_FOR_JOB', 'CANDIDATE_SHORTLISTED_FOR_JOB', 'NEW_CANDIDATE_REGISTERED', 'FOLLOW_COMPANY', 'FOLLOW_JOB', 'JOB_ALERT');

 update `notification_settings` set `type` = 'employee', `notification_settings`.`updated_at` = '2020-12-15 09:01:08' where `key` in ('MARK_COMPANY_FEATURED', 'NEW_EMPLOYER_REGISTERED', 'EMPLOYER_PURCHASE_PLAN');

insert into `settings` (`key`, `value`, `updated_at`, `created_at`) values ('is_full_slider', '0', '2020-12-15 09:01:08', '2020-12-15 09:01:08');
