create table `branding_sliders` (`id` int unsigned not null auto_increment primary key, `title` varchar(191) not null, `is_active` tinyint(1) not null default '1', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

insert into `notification_settings` (`key`, `type`, `value`, `updated_at`, `created_at`) values ('MARK_COMPANY_FEATURED_ADMIN', 'admin', true, '2020-12-18 09:01:08', '2020-12-18 09:01:08');

insert into `notification_settings` (`key`, `type`, `value`, `updated_at`, `created_at`) values ('MARK_JOB_FEATURED_ADMIN', 'admin', true, '2020-12-18 09:01:08', '2020-12-18 09:01:08');

update `notification_settings` set `type` = 'candidate', `notification_settings`.`updated_at` = '2020-12-24 09:01:08' where `key` in ('CANDIDATE_SELECTED_FOR_JOB', 'CANDIDATE_REJECTED_FOR_JOB', 'CANDIDATE_SHORTLISTED_FOR_JOB', 'JOB_ALERT');

update `notification_settings` set `type` = 'employer', `notification_settings`.`updated_at` = '2020-12-24 09:01:08' where `key` in ('MARK_JOB_FEATURED', 'MARK_COMPANY_FEATURED', 'JOB_APPLICATION_SUBMITTED', 'FOLLOW_COMPANY', 'FOLLOW_JOB');

update `notification_settings` set `type` = 'admin', `notification_settings`.`updated_at` = '2020-12-24 09:01:08' where `key` in ('MARK_COMPANY_FEATURED_ADMIN', 'MARK_JOB_FEATURED_ADMIN', 'NEW_EMPLOYER_REGISTERED', 'NEW_CANDIDATE_REGISTERED', 'EMPLOYER_PURCHASE_PLAN');
