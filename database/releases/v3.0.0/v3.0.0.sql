create table `social_accounts` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned not null, `provider` varchar(191) not null, `provider_id` varchar(191) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `social_accounts` add unique `social_accounts_user_id_provider_provider_id_unique`(`user_id`, `provider`, `provider_id`);

alter table `social_accounts` add constraint `social_accounts_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;

alter table `candidates` add `job_alert` tinyint(1) not null default '0';

create table `jobs_alerts` (`id` bigint unsigned not null auto_increment primary key, `candidate_id` int unsigned not null, `job_type_id` int unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `jobs_alerts` add constraint `jobs_alerts_candidate_id_foreign` foreign key (`candidate_id`) references `candidates` (`id`) on delete cascade on update cascade;

alter table `jobs_alerts` add constraint `jobs_alerts_job_type_id_foreign` foreign key (`job_type_id`) references `job_types` (`id`) on delete cascade on update cascade;

alter table `users` add `region_code` varchar(191) null;

insert into `settings` (`key`, `value`, `updated_at`, `created_at`) values ('region_code', '91', '2020-11-09 00:00:00', '2020-11-09 00:00:00')
insert into `settings` (`key`, `value`, `updated_at`, `created_at`) values ('company_url', 'www.infyom.com', '2020-11-24 00:00:00', '2020-11-24 00:00:00')

UPDATE `settings` SET `value`='70963 36561' where (`key` = 'phone') limit 1
