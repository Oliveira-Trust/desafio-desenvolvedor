# <img src="https://avatars.githubusercontent.com/u/58981329?s=200&v=4.jpg" alt="Logo Oliveira Trust" width="24"> Desafio Oliveira Trust 

## Indíce
* [Sobre](#about)
* [Requisitos](#requirements)
* [Setup](#setup)



<a name="about"></a>
## Sobre

Este projeto foi criado através do Desafio Oliveira Trust, e tem como objetivo fazer crud de Clientes, Produtos e Pedido de Compra.


<a name="requirements"></a>
## Requisitos

- PHP 7.4.14 ou mais recente
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- [composer](https://getcomposer.org/doc/00-intro.md)

<a name="setup"></a>
## Setup

Instale as dependências:

```sh 
composer install
```

Configure o arquivo .env: *
```sh
nano .env
```
<sub>*Se o arquivo não for criado automaticamente depois do composer install, faça uma cópia do .env.example.</sub>

Rode as migrations:
```sh
php artisan migrate
```

Rode as seeders:
<sub>* Ao rodar as seeders como estão, irão gerar produtos, categorias e 100 clientes. Caso não queira, basta comentar das linhas ``27 a 38`` do arquivo ``DatabaseSeeder.php`` em ``database/seeders/``. </sub>
```sh
php artisan db:seed
```

Um usuário será criado. Para utiliza-lo, basta acessar ``/login`` com o acesso: ``admin@admin.com`` e a senha ``password``.