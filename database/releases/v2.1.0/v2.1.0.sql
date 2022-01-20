alter table `jobs` drop `is_featured`;

alter table `companies` drop `is_featured`;

ALTER TABLE featured_records CHANGE stripe_id stripe_id VARCHAR(191) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE meta meta TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`;
