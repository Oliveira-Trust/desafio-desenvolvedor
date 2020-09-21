
# Controle de Clientes e Pedidos de Compra


Neste projeto, foram utilizados os princípios do SOLID visando separa-lo em camadas. O CRUD foi feito em PHP e Mysql, e foram realizados os seguintes pontos:

## O que foi feito/falta ser feito

**Básico:**
-  - [x] CRUD de Clientes
-  - [x] CRUD de Produtos
-  - [x] CRUD de Pedidos de Compra
-  - [] Filtrar e Ordenar listagens por qualquer campo
-  - [x] Barra de Navegação entre CRUDs
-  - [x] Links para os outros CRUDs nas listagens (Ex: link para o detalhe do cliente da compra na lista de pedidos de compra)

**Bônus:**
-  - [x] Implementar autenticação de usuário na aplicação.
-  - [x] Permitir deleção em massa de itens nos CRUDs.
-  - [x] Implementar a camada de Front-End utilizando a biblioteca javascript Bootstrap e ser responsiva.
-  - [x] API Rest JSON para todos os CRUDS listados acima. para usar use localhost/api/ "produtos" , "clientes",""pedidos"



## Instalação

Clone o Repositório

Entre no diretório.

> cd desafio-desenvolvedor

Gere o arquivo `.env` baseado no `.env.example`

> cp .env.example .env

"Suba" com o container

> docker-compose up -d --build

Instale as dependências utilizando o `composer`
> docker-compose exec php bash -c "composer install"

Gere a `APP_KEY` do Projeto
> docker-compose exec php bash -c "php artisan key:generate"

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

