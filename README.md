# products-store

Aplicação back-end que simula uma loja.

## Tecnologias

- Laravel
- PHP
- Eloquent
- PHPUnit
- MySQL
- Composer

## Preparação do ambiente

Clonando o projeto
```
git clone https://github.com/LucasMorais582/desafio-desenvolvedor.git
```

## Pré-requisitos:
- Primeiramente é necessário instalar o PHP, algumas de suas extensões e o Composer, todas as informações você encontra na documentação do [Laravel](https://laravel.com/docs/7.x/installation)

## Banco de dados:
- O primeiro passo é instalar o [Docker](https://docs.docker.com/engine/install/) na sua máquina
- Em seguida, instalar a imagem do [Mysql](https://hub.docker.com/_/mysql). Caso nunca tenha utilizado o Mysql na sua máquina, é necessário criar seu login para ter acesso.
- Criar um banco de dados com o nome: "products_store" ou com o nome que desejar, desde que altere também no .env. (Nesse passo, pode-se utilizar o phpAdmin ou algum programa como o [Dbeaver](https://dbeaver.io/) ou [Mysql Workbanch](https://www.mysql.com/products/workbench/) para realizar a conexão com a imagem).


## Passos para inicializar a aplicação:

Criar o arquivo .env inspirado no .env.example e configurar as informaçes do banco

Instalar todas as dependencias:
```
composer install
```

Após entrar no diretório do projeto pelo terminal, realizar a criação das tabelas do banco com os comandos:
```
php artisan migrate --path=/database/migrations/2014_10_12_000000_create_users_table.php
php artisan migrate --path=/database/migrations/2014_10_12_100000_create_password_resets_table.php
php artisan migrate --path=/database/migrations/2019_08_19_000000_create_failed_jobs_table.php
php artisan migrate --path=/database/migrations/2020_10_04_012330_create_categories_table.php
php artisan migrate --path=/database/migrations/2020_10_04_012320_create_products_table.php
php artisan migrate --path=/database/migrations/2020_10_04_012912_create_sales_table.php
php artisan migrate --path=/database/migrations/2020_10_04_035138_create_product_sales_table.php
php artisan migrate --path=/database/migrations/2020_10_05_163531_update_product_sales.php
php artisan migrate --path=/database/migrations/2020_10_06_121837_alterar_column_image.php
php artisan migrate --path=/database/migrations/2020_10_06_125145_alter_table_products_sale.php
```
Gerar chave específica para utilização da API:
```
php artisan key:generate
```

Inicializar a aplicação com o comando:
```
php artisan serve
```

Para acessar a aplicação, utilize uma API Client como [Postman](https://www.postman.com/) ou [Insomnia Core](https://insomnia.rest/download/):
- http://localhost:8000
