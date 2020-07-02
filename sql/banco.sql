create database if not exists oliveiratrust;
use oliveiratrust;


create table clientes
(
    prk  int auto_increment
	primary key,
    nomeCliente varchar(50) not null
);


CREATE TABLE pedidos (

	prk int not null auto_increment,
	frkCliente int not null,
	frkProduto int not null,
	status char not null,
	primary key  (prk),
	foreign key  (frkCliente) references clientes(prk),
	foreign key (frkProduto) references produtos(prk)
);


create table produtos
(
    prk  int auto_increment
	primary key,
    nomeProduto  varchar(50)   not null,
    precoProduto decimal(7, 2) not null
);


create table usuarios
(
    prk  int auto_increment
	primary key,
    email varchar(50) not null,
    senha varchar(60) not null,
    constraint usuarios_email_uindex
	unique (email)
);


