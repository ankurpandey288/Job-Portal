create table `image_sliders` (`id` int unsigned not null auto_increment primary key, `description` text null, `is_active` tinyint(1) not null default '1', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

insert into `settings` (`key`, `value`, `updated_at`, `created_at`) values ('is_active', 1, '2020-11-24 00:00:00', '2020-11-24 00:00:00');

UPDATE `settings` SET `key`='slider_is_active' WHERE (`key` = 'is_active') limit 1;

insert into `front_settings` (`key`, `value`, `updated_at`, `created_at`) values ('latest_jobs_enable', false ,'2020-11-24 00:00:00', '2020-11-24 00:00:00');
