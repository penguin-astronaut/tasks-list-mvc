CREATE TABLE users (
   `id` int unsigned not null auto_increment,
   `login` varchar(100) not null,
   `password` varchar(60) not null,
   `created_at` timestamp default current_timestamp,
   primary key (id)
)
engine = innodb
auto_increment = 1
character set utf8
collate utf8_general_ci;