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

## Microserviço Principal - Autenticação de Usuário e Cotação de Valores  
Este microserviço é responsável por autenticar o usuário, realizar a cotação solicitada pelo usuário e fornecer
histórico das cotações.  
Permite ao usuário com perfil de administrador gerenciar o CRUD de Taxas, Moedas e Meios de Pagamento, além de 
visualizar o histórico geral de todos os usuários e fazer buscas no histórico através de filtros.  

## ⚙️ Instalação e execução
Após ter clonado o repositório, acessar a pasta `main-service` e digitar o comando abaixo.  
Todas as dependências serão instaladas automaticamente durante a criação dos containers.
```sh
docker-compose up -d
```
## OBS
A rede externa do docker já deverá ter sido criada. Após clonar o projeto, criar a rede externa deverá ser o primeiro passo
para instalação da aplicação.
```sh
docker network create oliveira-trust 
```

## Acessar o Sistema
Abrir algum browser e acessar a url `http://localhost:8000`.  
- Usuário Admin - Acesso a todas as funcinalidades do sistema.  
Login: admin@email.com  
Senha: secret  

- Usuário comun  
Login: user@email.com  
Senha: secret  

**OBS.:** para que o email seja enviado, será necessário cadastrar um novo usuário com um email válido e 
ter configurado o microserviço de envio de email corretamente.

Desenvolvido por Thiago Luna: [Linkedin!](https://www.linkedin.com/in/thiago-luna/)


