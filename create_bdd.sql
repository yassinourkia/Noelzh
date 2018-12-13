START TRANSACTION;

drop table if exists users;
create table users (
	id			int primary key auto_increment,
	email		varchar(50) not null,
	password	varchar(60) not null,
	name		varchar(50) not null,
	phone		int(12) not null,
	avatar		longblob not null,
	address		varchar(100) not null,
	admin		int(1) not null,
    unique(email)
);

drop table if exists orders;
create table orders (
    id			int primary key auto_increment,
    id_users	int not null,
    date		datetime default current_timestamp,
    amount		float not null,
    foreign key (id_users) references users(id)
);

drop table if exists categories;
create table categories (
	id		int primary key auto_increment,
    name	varchar(50) not null,
    unique (name)
);

drop table if exists products;
create table products (
    id			int primary key auto_increment,
    name		varchar(50) not null,
    description varchar(200) not null,
    price		float not null,
    quantity    int not null,
    size      	varchar(10) not null,
    picture		longblob not null
);

drop table if exists a_products_categories;
create table a_products_categories (
    id_categories	int,
    id_products		int,
    primary key (id_categories, id_products),
    foreign key (id_categories) references categories(id),
    foreign key (id_products) references products(id)
);

drop table if exists a_products_orders;
create table a_products_orders (
    id_orders	int,
    id_products	int,
	quantity	int not null,
    primary key (id_orders, id_products),
    foreign key (id_orders) references orders(id),
    foreign key (id_products) references products(id) 
);

drop table if exists ratings;
create table ratings (
    id			int primary key auto_increment,
    text		varchar(300) not null,
    rating		int not null,
    id_products	int not null,
    id_users	int not null,
    foreign key (id_products) references products(id),
    foreign key (id_users) references users(id)
);

drop table if exists messages;
create table messages (
	id			int primary key auto_increment,
	id_users	int not null,
    date		datetime default current_timestamp,
    message		varchar(500) not null,
    foreign key (id_users) references users(id)
);

COMMIT;
