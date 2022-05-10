CREATE TABLE tasks (
    `id` int unsigned not null auto_increment,
    `user_id` int unsigned not null,
    `description` text not null,
    `status` enum('ready', 'unready'),
    `created_at` timestamp default current_timestamp,
    INDEX par_ind (`user_id`),
    FOREIGN KEY (`user_id`)
        REFERENCES users(`id`)
        ON DELETE CASCADE,
    primary key (id)
)
engine = innodb
auto_increment = 1
character set utf8
collate utf8_general_ci;
