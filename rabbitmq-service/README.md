<h2 align="center">
    <img src="https://avatars.githubusercontent.com/u/58981329?s=200&v=4" alt="Oliveira Trust" width="24" /> Desafio Desenvolvedor
</h2>

## 🚀 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:  

- [PHP 7.4](https://php.net)
- [Laravel 8](https://laravel.com)
- [MySQL 5.7](https://mysql.com)
- [Docker](https://docker.com)
- [Redis](https://redis.io)
- [RabbitMQ](https://www.rabbitmq.com/)


## 💻 Projeto

Esse projeto é uma uma aplicação que faz a conversão da nossa moeda nacional para uma moeda estrangeira, 
aplicando algumas taxas e regras, apresentando no final da conversão o resultado detalhado.

Foi feita a integração com a API pública [AwesomeAPI](https://docs.awesomeapi.com.br/api-de-moedas),
que entrega cotações de verdade e atuais.

## Microserviço De Mensageria com RabbitMQ  
Este microserviço é responsável por gerenciar as filas da aplicação para troca de mensagens entre os microserviços.  

## ⚙️ Instalação e execução
Após ter clonado o repositório, **e ter criado a rede externa**, acessar a pasta `rabbitmq-service` e digitar o comando abaixo.  
```sh
docker-compose up -d
```

## OBS
A rede externa do docker já deverá ter sido criada. Após clonar o projeto, criar a rede externa deverá ser o primeiro passo 
para instalação da aplicação.

Desenvolvido por Thiago Luna: [Linkedin!](https://www.linkedin.com/in/thiago-luna/)


