create database if not exists ot_store;

use ot_store;

create table clients (
    id int primary key not null auto_increment,
    name varchar(20) not null,
    email varchar(30) not null
);

create table users (
    id int primary key not null auto_increment,
    name varchar(20) not null,
    password varchar(40) not null,
    email varchar(30) not null
);

create table products (
    id int primary key not null auto_increment,
    name varchar(20) not null,
    price numeric(6,2) not null
);

create table purchaseOrder (
    id int not null auto_increment,
    clientId int not null,
    productId int not null,
    qtd smallint not null,
    status enum('Em aberto', 'Pago', 'Cancelado'),
    foreign key (clientId) references clients(id),
    foreign key (productId) references products(id),
    primary key (id, productId, clientId)
)