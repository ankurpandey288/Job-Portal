create table `notifications` (`id` int unsigned not null auto_increment primary key, `type` int not null, `notification_for` int not null, `user_id` bigint unsigned not null, `title` varchar(191) not null, `text` text null, `meta` text null, `read_at` timestamp null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `notifications` add constraint `notifications_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;

alter table `salary_currencies` add `currency_icon` varchar(191) not null default '$';

create table `notification_settings` (`id` bigint unsigned not null auto_increment primary key, `key` varchar(191) not null, `value` text not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

insert into `notification_settings` (`key`, `value`, `updated_at`, `created_at`) values ('JOB_APPLICATION_SUBMITTED', true , '2020-12-11 00:00:00', '2020-11221100:00:00');
insert into `notification_settings` (`key`, `value`, `updated_at`, `created_at`) values ('MARK_JOB_FEATURED', true , '2020-12-11 00:00:00', '2020-12-11 00:00:00');
insert into `notification_settings` (`key`, `value`, `updated_at`, `created_at`) values ('MARK_COMPANY_FEATURED', true , '2020-12-11 00:00:00', '2020-11221100:00:00');
insert into `notification_settings` (`key`, `value`, `updated_at`, `created_at`) values ('CANDIDATE_SELECTED_FOR_JOB', true , '2020-12-11 00:00:00', '2020-11221100:00:00');
insert into `notification_settings` (`key`, `value`, `updated_at`, `created_at`) values ('CANDIDATE_REJECTED_FOR_JOB', true , '2020-12-11 00:00:00', '2020-11221100:00:00');
insert into `notification_settings` (`key`, `value`, `updated_at`, `created_at`) values ('CANDIDATE_SHORTLISTED_FOR_JOB', true , '2020-12-11 00:00:00', '2020-12-11 00:00:00');
insert into `notification_settings` (`key`, `value`, `updated_at`, `created_at`) values ('NEW_EMPLOYER_REGISTERED', true , '2020-12-11 00:00:00', '2020-11221100:00:00');
insert into `notification_settings` (`key`, `value`, `updated_at`, `created_at`) values ('NEW_CANDIDATE_REGISTERED', true , '2020-12-11 00:00:00', '2020-11221100:00:00');
insert into `notification_settings` (`key`, `value`, `updated_at`, `created_at`) values ('EMPLOYER_PURCHASE_PLAN', true , '2020-12-11 00:00:00', '2020-11221100:00:00');
insert into `notification_settings` (`key`, `value`, `updated_at`, `created_at`) values ('FOLLOW_COMPANY', true , '2020-12-11 00:00:00', '2020-12-11 00:00:00');
insert into `notification_settings` (`key`, `value`, `updated_at`, `created_at`) values ('FOLLOW_JOB', true , '2020-12-11 00:00:00', '2020-12-11 00:00:00');
insert into `notification_settings` (`key`, `value`, `updated_at`, `created_at`) values ('JOB_ALERT', true , '2020-12-11 00:00:00', '2020-12-11 00:00:00');
