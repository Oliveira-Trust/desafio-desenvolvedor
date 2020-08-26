CREATE DATABASE desafioOliveiraRM
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS desafioOliveiraRM.produtos (
	id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	descricao TEXT NOT NULL,
	preco FLOAT(5,2)
);


CREATE TABLE desafioOliveiraRM.clientes (
	id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	login VARCHAR(50) NOT NULL,
	senha VARCHAR(255) NOT NULL,
	nome VARCHAR(255) NOT NULL,
	cpf VARCHAR(11) UNIQUE NOT NULL,
	tel VARCHAR(21) NOT NULL, 
	email VARCHAR(100) UNIQUE NOT NULL	
);


CREATE TABLE IF NOT EXISTS desafioOliveiraRM.pedidos (
	id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	status ENUM ('Em Aberto', 'Pago', 'Cancelado') NOT NULL,
	cliente_id INT NOT NULL,
	data_criacao DATETIME NOT NULL,
	data_atualizacao DATETIME NOT NULL,
	FOREIGN KEY pedidos_cliente_id_foreign (cliente_id) REFERENCES clientes(id)
);


CREATE TABLE IF NOT EXISTS desafioOliveiraRM.pedido_produtos (
	id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	produto_id INT NOT NULL,
	pedido_id INT NOT NULL,
	produto_quant INT NOT NULL DEFAULT 1,
	FOREIGN KEY pedido_produtos_produto_id_foreign (produto_id) REFERENCES produtos(id),
	FOREIGN KEY pedido_produtos_pedido_id_foreign (pedido_id) REFERENCES pedidos(id)
);