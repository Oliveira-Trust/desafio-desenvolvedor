create database ot_store;

use ot_store;

create table clients (
    id int primary key not null auto_increment,
    name varchar(20) not null,
    password varchar(40) not null,
    email varchar(30) not null
)

create table products (
    id int primary key not null auto_increment,
    name varchar(20) not null,
    price numeric(6,2) not null
)

create table purchaseOrder (
    clientId int not null,
    productId int not null,
    quantity smallint not null,
    status enum('Em aberto', 'Pago', 'Cancelado'),
    foreign key clientId references clientes(id),
    foreign key productId references products(id),
    primary key (productId, clientId)
)

