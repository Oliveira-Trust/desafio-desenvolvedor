
# Controle de Clientes e Pedidos de Compra

Projeto desenvolvido em Laravel e Mysql implementando um CRUD simples para Clientes, Produtos e Pedidos de Compra

## O que foi feito/falta ser feito

**Básico:**
-  - [x] CRUD de Clientes
-  - [x] CRUD de Produtos
-  - [x] CRUD de Pedidos de Compra
-  - [x] Filtrar e Ordenar listagens por qualquer campo
-  - [x] Barra de Navegação entre CRUDs
-  - [x] Links para os outros CRUDs nas listagens (Ex: link para o detalhe do cliente da compra na lista de pedidos de compra)

**Bônus:**
-  - [x] Implementar autenticação de usuário na aplicação.
-  - [ ] Permitir deleção em massa de itens nos CRUDs.
-  - [x] Implementar a camada de Front-End utilizando a biblioteca javascript Bootstrap e ser responsiva.
-  - [x] API Rest JSON para todos os CRUDS listados acima. para usar use localhost/api/ "produtos" , "clientes",""pedidos"

## Instalação

Clone o Repositório(`desafio-desenvlvedor`)  

Entre no diretório `desafio-desenvolvedor`.

> cd desafio-desenvolvedor

Gere o arquivo `.env` baseado no `.env.example`

> cp .env.example .env

"Suba" com o container

> docker-composer up -d --build

Instale as dependências utilizando o `composer`
> docker-composer exec php bash -c "composer install"

Gere a `APP_KEY` do Projeto
> docker-composer exec php bash -c "php artisan key:generate"

De permissões de escrita e leitura para as pastas dentro de `/storage` 
> chmod -R 777 storage

Crie os Bancos de dados referente a aplicação e aos testes
> docker-composer exec mysql mysql -p
> CREATE DATABASE laravel
> CREATE DATABASE laravel_tests

Configure as variáveis de ambiente no .env
* `DB_` Dados de conexão com o mysql
* `TEST_DB_` Dados de conexão com o mysql para testes unitários

Execute as migrations(se quiser execute com `--seed` que irá executar os seeders)
> docker-composer exec php bash -c "php artisan migrate"


### Testing  

>docker-compose exec php bash -c "./vendor/bin/phpunit tests"
