CREATE TABLE migrations (
   `id` int unsigned not null auto_increment,
   `name` varchar(100) not null,
   `created_at` timestamp default current_timestamp,
   primary key (id)
)