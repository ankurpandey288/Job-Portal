alter table `plans`
    add `salary_currency_id` int unsigned not null after `amount`;

alter table `salary_currencies`
    add `currency_code` varchar(191) not null after `currency_icon`;
