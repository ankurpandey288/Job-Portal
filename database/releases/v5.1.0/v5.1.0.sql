ALTER TABLE subscriptions CHANGE stripe_status stripe_status VARCHAR (191) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`;
alter table `subscriptions`
    add `type` varchar(191) not null default '1', add `paypal_payment_id` varchar(191) null;
