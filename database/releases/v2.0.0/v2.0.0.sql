create table `plans` (`id` int unsigned not null auto_increment primary key, `name` varchar(191) not null, `stripe_plan_id` varchar(191) null, `allowed_jobs` int not null, `amount` double not null, `is_trial_plan` tinyint(1) not null default '0', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `plans` add unique `plans_name_unique`(`name`);

create table `subscriptions` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned not null, `name` varchar(191) not null, `stripe_id` varchar(191) null, `stripe_status` varchar(191) not null, `stripe_plan` varchar(191) null, `plan_id` int unsigned null, `trial_ends_at` timestamp null, `ends_at` timestamp null, `current_period_start` timestamp null, `current_period_end` timestamp null, `cancellation_reason` varchar(191) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `subscriptions` add index `subscriptions_user_id_stripe_status_index`(`user_id`, `stripe_status`);

alter table `subscriptions` add constraint `subscriptions_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete CASCADE on update CASCADE;

alter table `subscriptions` add constraint `subscriptions_plan_id_foreign` foreign key (`plan_id`) references `plans` (`id`) on delete CASCADE on update CASCADE;

create table `transactions` (`id` int unsigned not null auto_increment primary key, `user_id` bigint unsigned not null, `subscription_id` bigint unsigned not null, `invoice_id` varchar(191) null, `amount` double(8, 2) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `transactions` add constraint `transactions_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete CASCADE on update CASCADE;

alter table `transactions` add constraint `transactions_subscription_id_foreign` foreign key (`subscription_id`) references `subscriptions` (`id`) on delete CASCADE on update CASCADE;

create table `subscription_items` (`id` bigint unsigned not null auto_increment primary key, `subscription_id` bigint unsigned not null, `stripe_id` varchar(191) not null, `stripe_plan` varchar(191) not null, `quantity` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `subscription_items` add unique `subscription_items_subscription_id_stripe_plan_unique`(`subscription_id`, `stripe_plan`);

alter table `subscription_items` add index `subscription_items_stripe_id_index`(`stripe_id`);

alter table `users` add `stripe_id` varchar(191) null;

create table `featured_records` (`id` bigint unsigned not null auto_increment primary key, `owner_id` int unsigned not null, `owner_type` varchar(191) not null, `user_id` bigint unsigned not null, `stripe_id` varchar(191) not null, `start_time` datetime not null, `end_time` datetime not null, `meta` text not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `featured_records` add constraint `featured_records_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;

create table `front_settings` (`id` bigint unsigned not null auto_increment primary key, `key` varchar(191) not null, `value` text not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `plans` add `deleted_at` timestamp null;

alter table `transactions` add `owner_id` int unsigned not null, add `owner_type` varchar(191) not null;

alter table `transactions` drop foreign key `transactions_subscription_id_foreign`;

alter table `transactions` drop `subscription_id`;

insert into `plans` (`name`, `allowed_jobs`, `amount`, `is_trial_plan`, `updated_at`, `created_at`)
values ('Trial Plan', 1, 0, 1, '2020-10-10 00:00:00', '2020-10-10 00:00:00');

alter table `jobs` drop `is_featured`;

 alter table `companies` drop `is_featured`;

insert into `front_settings` (`key`, `value`, `updated_at`, `created_at`)
 values (
    'featured_jobs_price',
    0,
    '2020-10-10 00:00:00',
    '2020-10-10 00:00:00'
 );

insert into `front_settings` (`key`, `value`, `updated_at`, `created_at`)
 values (
    'featured_jobs_days',
    10,
    '2020-10-10 00:00:00',
    '2020-10-10 00:00:00'
 );

insert into `front_settings` (`key`, `value`, `updated_at`, `created_at`)
 values (
    'featured_jobs_quota',
    10,
    '2020-10-10 00:00:00',
    '2020-10-10 00:00:00'
 );

insert into `front_settings` (`key`, `value`, `updated_at`, `created_at`)
 values (
    'featured_companies_price',
    0,
    '2020-10-10 00:00:00',
    '2020-10-10 00:00:00'
 );

insert into `front_settings` (`key`, `value`, `updated_at`, `created_at`)
 values (
    'featured_companies_days',
    10,
    '2020-10-10 00:00:00',
    '2020-10-10 00:00:00'
 );

insert into `front_settings` (`key`, `value`, `updated_at`, `created_at`)
 values (
    'featured_companies_quota',
    10,
    '2020-10-10 00:00:00',
    '2020-10-10 00:00:00'
 );

insert into `front_settings` (`key`, `value`, `updated_at`, `created_at`)
 values (
    'featured_jobs_enable',
    0,
    '2020-10-10 00:00:00',
    '2020-10-10 00:00:00'
 );

insert into `front_settings` (`key`, `value`, `updated_at`, `created_at`)
 values (
    'featured_companies_enable',
    0,
    '2020-10-10 00:00:00',
    '2020-10-10 00:00:00'
 );

