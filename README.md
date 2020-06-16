<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Sobre a API

Desenvolvimento de uma API REST para Gerenciar Pedidos de clientes e também foi desenvolvido o Front-END para consumir a API desenvolvida. Foi utilizado as seguintes tecnologias abaixo:

- PHP 7.4
- Laravel 7.1
- JWT 1.0.0
- MariaDb
- JSON
- HTTP 1.1
- Bootstrap 4
- JQuery
- JavaScript
- HTML
- CSS
- Materialize Icons


## Processo de instalação

- Fazer uma cópia do arquivo .env.example e salvar como .env
- Criar um vhost em seu servidor para a pasta public do projeto
- Criar um database chamado pedidos, com charset utf8 e collation utf8_unicode_ci
- Executar o comando php artisan migrate
- Executar o comando php artisan db:seed


## Utilização dos EndPoints

- **ENDPOINT - Users**

- Listagem de todos os usuários  
**GET**  http://seuservidor/api/v1/users

- Listagem de um usuário específico  
**GET**  http://seuservidor/api/v1/users/#ID

- Novo Usuário  
**POST**  http://seuservidor/api/v1/users   
**CAMPOS**  
name = nome do usuário  
email = email do usuário  
password = senha do usuário  
password_confirmation = confirmação da senha  

- Alterar Usuário
**PUT**  http://seuservidor/api/v1/users  
**CAMPOS**  
name = nome do usuário  
email = email do usuário  
password = senha do usuário  
password_confirmation = confirmação da senha  

- Excluir Usuário
**DELETE**  http://seuservidor/api/v1/users/#ID_USUARIO  
**CAMPOS**  
#ID_USUARIO = Id do usuário que deseja-se excluir  

- **ENDPOINT - Login**
- Gerar token de acesso a API  
**POST**  http://seuservidor/api/v1/login  
**CAMPOS**  
email = email do usuário  
password = senha do usuário  

**Para utilizar qualquer endpoint é necessário informar o token de acesso no cabeçalho da requisição acrescido da palavra**
**Bearer #token_a_ser_utilizado**

