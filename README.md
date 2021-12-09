# Desafio de Conversão Monetária

- [Desafio de Busca utilizando o selene framework](#desafio-de-busca-utilizando-o-selene-framework)
  - [Introdução](#introdução)
  - [Conceitos](#conceitos)
  - [Instalação](#instalação)
    - [Pré-requisitos.](#pré-requisitos)
    - [Imagens utilizadas neste projeto](#imagens-utilizadas-neste-projeto)
    - [Clonando o projeto](#clonando-o-projeto)
    - [Estrutura do projeto](#estrutura-do-projeto)
  - [Comandos do make](#comandos-do-make)
  - [Executando a aplicação e rodando o dump do banco de dados do desafio de busca](#executando-a-aplicação-e-rodando-o-dump-do-banco-de-dados-do-desafio-de-busca)
  - [Executando a aplicação com banco de dados padrão](#executando-a-aplicação-com-banco-de-dados-padrão)
  - [Verificando os logs da aplicação](#verificando-os-logs-da-aplicação)
  - [Acessando a aplicação no navegador](#acessando-a-aplicação-no-navegador)
  - [Parando a aplicação e limpando os serviços](#parando-a-aplicação-e-limpando-os-serviços)
  - [A API de busca](#a-api-de-busca)
    - [Endpoints](#endpoints)
    - [Parâmetros de URL](#parâmetros-de-url)
      - [Exemplo de requisição com parâmetros de URL](#exemplo-de-requisição-com-parâmetros-de-url)
  - [Comandos do docker](#comandos-do-docker)
    - [Instalando pacotes com composer](#instalando-pacotes-com-composer)
    - [Atualizando dependências PHP com composer](#atualizando-dependências-php-com-composer)
    - [Gerando documentações com PHPDOC](#gerando-documentações-com-phpdoc)
    - [Testando a aplicação com o phpunit](#testando-a-aplicação-com-o-phpunit)
    - [Ajustando o código-fonte com o padrão da PSR2](#ajustando-o-código-fonte-com-o-padrão-da-psr2)
    - [Analisando o código-fonte com PHPCS](#analisando-o-código-fonte-com-phpcs)
    - [Analisando o código-fonte com PHPMD](#analisando-o-código-fonte-com-phpmd)
    - [Verificando as extensões do PHP instaladas](#verificando-as-extensões-do-php-instaladas)
  - [Manipulando o banco de dados](#manipulando-o-banco-de-dados)
    - [Acesso ao MySQL](#acesso-ao-mysql)
      - [Criando um backup de todos os bancos de dados](#criando-um-backup-de-todos-os-bancos-de-dados)
      - [Restaurando um backup de todos os bancos de dados](#restaurando-um-backup-de-todos-os-bancos-de-dados)
      - [Criando um backup de um único banco de dados](#criando-um-backup-de-um-único-banco-de-dados)
      - [Restaurando um backup de um único banco de dados](#restaurando-um-backup-de-um-único-banco-de-dados)

___

## Introdução

Este repositório provê uma aplicação cliente, onde é possível realizar as ações de conversão de moeda, visualizar histório de conversões, etc. O repositório provê também uma API para busca das cotações de moedas para conversão.
___

## Tecnologias utilizadas

* PHP 8.1
* Framework PHP [Selene](https://github.com/ovalves/selene).
* Mysql
    * Guarda os dados de criação de usuários
    * Guarda os dados de sessão
* MongoDB
    * Guarda os dados das conversões realizadas
    * Guarda o histórico das conversões
    * Guarda as taxas aplicadas nas conversões
    * Guarda os códigos das moedas para a realização das conversões
* nginx
* PHP-FPM
* Docker
* HTML5
* CSS3
* Javascript (Jquery)
___

## Como rodar o projeto
PS.: Utilize os comando do Make para rodar o projeto mais facilmente

* Copie o arquivo .env.example para .env
* Use o comando make start-with-db no seu terminal
    * Este comando irá criar a base de dados do mysql e irá subir todos os serviços do docker
* Crie as collections (currency_codes, payment e tax) do MongoDB. As collections estão localizadas em data/mongo-collections
* Acesse o projeto no seu navegador http://localhost:8000
    * Acessando como admin
        * email: admin@oliveiratrust.com.br
        * senha: admin
    * Acessando como cliente
        * email: cliente@oliveiratrust.com.br
        * senha: cliente

### Para rodar o dump do mysql sem usar o makefile
```bash
docker exec -i ID_DO_CONTAINER mysql -uroot -proot < data/db/dumps/selene.sql
```

___

## Conceitos

Como definição para a resolução do problema de conversão monetária. Temos:

* Deve ser possível escolher uma moeda estrangeira entre pelo menos 2 opções
* O seu valor de compra deve ser **maior** que R$ 1.000 e **menor** que R$ 100.000,00
* Deve ter formas de pagamento em **boleto** ou **cartão de crédito**
* Deve exibir no final da operação: O valor que será adquirido na **moeda de destino** e as **taxas aplicadas**;
___

## Regras do desafio

### Usabilidade
- Usuário deve informar 3 informações em tela
- moeda de destino
- valor para conversão
- forma de pagamento.
- A nossa moeda nacional BRL será usada como moeda base na conversão.

### Regras de négocio
- Moeda de origem BRL;
- Informar uma moeda de compra que não seja BRL (exibir no mínimo 2 opções);
- Valor da Compra em BRL (deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00)
- Formas de pagamento (taxas aplicadas no valor da compra e aceitar apenas as opções abaixo)
    - Para pagamentos em boleto, taxa de 1,45%
    - Para pagamentos em cartão de crédito, taxa de 7,63%
- Aplicar taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00,
essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento.

___

## Instalação

Antes de instalar o projeto, certifique-se de possuir os seguintes pré-requisitos.

### Pré-requisitos.

Os seguintes requisitos devem estar instalados em sua máquina:

* [Git](https://git-scm.com/downloads)
* [Docker](https://docs.docker.com/engine/installation/)
* [Docker Compose](https://docs.docker.com/compose/install/)
___

### Imagens utilizadas neste projeto

* [Nginx](https://hub.docker.com/_/nginx/)
* [MySQL](https://hub.docker.com/_/mysql/)
* [MongoDB](https://hub.docker.com/_/mongo)
* [PHP-FPM](https://hub.docker.com/r/devilbox/php-fpm/)
* [Composer](https://hub.docker.com/_/composer/)
* [PHPMyAdmin](https://hub.docker.com/r/phpmyadmin/phpmyadmin/)

As seguintes portas são utilizadas neste projeto:

| Server     | Port  |
|------------|-------|
| MySQL      | 8989  |
| MongoDB    | 27017 |
| PHPMyAdmin | 8080  |
| Nginx      | 8000  |
| Nginx SSL  | 3000  |
___

### Clonando o projeto

O código do repositório será baixado do GitHub.

Acesse [Git](http://git-scm.com/book/en/v2/Getting-Started-Installing-Git), faça o download e instale seguindo as instruções:

```bash
git clone git@github.com:ovalves/selene-project-a.git
```

Acesse o diretório do projeto:

```sh
cd selene-project-a
```
___

### Estrutura do projeto

```sh
├── data
│   ├── db
│   │   ├── dumps
│   │   └── mysql
│   └── mongo-collections
├── etc
│   ├── nginx
│   │   ├── default.conf
│   │   └── default.template.conf
│   ├── php
│   │   └── php.ini
│   └── ssl
├── storage
│   └── logs
├── web
│   ├── app
│   │   ├── composer.json
│   │   ├── phpunit.xml
│   │   ├── .php-cs-fixer.php
│   │   ├── src
│   │   │   ├── Actions
│   │   │   ├── Config
│   │   │   ├── Controllers
│   │   │   ├── Events
│   │   │   ├── Exceptions
│   │   │   ├── Gateway
│   │   │   ├── Mails
│   │   │   ├── Models
│   │   │   ├── Notifications
│   │   │   ├── Services
│   │   │   └── Storage
│   │   │   └── Tasks
│   │   │   └── Tests
│   │   │   └── Traits
│   │   └── tests
│   │       └── Api
│   ├── conf
│   │   └── .env
│   └── public
│       ├── Views
│       └── index.php
├── docker-compose.yml
├── .php-cs-fixer.php
├── .editorconfig
├── .env
├── Makefile
└── README.md
```
___

## Comandos do make

Os seguintes comandos estão disponíveis através do `make`:

| Name          | Description                                                   |
|---------------|---------------------------------------------------------------|
| phpdoc        | Gerador de documentação de do código PHP                      |
| clean         | Rodar o Code Sniffer no código PHP (PSR2)                     |
| code-sniff    | Limpar os diretórios necessários para reiniciar os containers |
| composer-up   | Atualizar as dependências do PHP utilizando o composer        |
| start         | Iniciar todos os serviços                                     |
| stop          | Parar todos os serviços                                       |
| logs          | Visualizar os logs dos serviços                               |
| mysql-dump    | Criar backup de todos os bancos de dados                      |
| mysql-restore | Restaurar o backup de todos os bancos de dados                |
| phpmd         | Rodar o PHP Mess Detector no código PHP                       |
| test          | Rodar os testes da aplicação                                  |

___

## Executando a aplicação e rodando o dump do banco de dados do desafio
Executando a aplicação:
```sh
make start-with-db
```
___

## Executando a aplicação com banco de dados padrão
```sh
make start
```
___

## Verificando os logs da aplicação
    ```sh
    make logs
    ```
___

## Acessando a aplicação no navegador
* [http://localhost:8000](http://localhost:8000/)
* [https://localhost:3000](https://localhost:3000/)
* [http://localhost:8080](http://localhost:8080/) PHPMyAdmin (username: dev, password: dev)

___

## Parando a aplicação e limpando os serviços
```sh
make stop # Talvez você tenha que rodar este comando usando o sudo
```
___

## Comandos do docker

### Instalando pacotes com composer

```sh
docker run --rm -v $(pwd)/web/app:/app composer require symfony/dotenv
```
___

### Atualizando dependências PHP com composer

```sh
docker run --rm -v $(pwd)/web/app:/app composer update
```
___

### Gerando documentações com PHPDOC

```sh
docker run --rm -v $(pwd):/data phpdoc/phpdoc -i=vendor/ -d /data/web/app/src -t /data/web/app/doc
```
___

### Testando a aplicação com o phpunit

```sh
docker-compose exec -T php ./app/vendor/bin/phpunit --colors=always --configuration ./app
```
___

### Ajustando o código-fonte com o padrão da PSR2

* [PSR2](http://www.php-fig.org/psr/psr-2/)

```sh
docker-compose exec -T php ./app/vendor/bin/phpcbf -v --standard=PSR2 ./app/src
```
___

### Analisando o código-fonte com PHPCS

* [PSR2](http://www.php-fig.org/psr/psr-2/)

```sh
docker-compose exec -T php ./app/vendor/bin/phpcs -v --standard=PSR2 ./app/src
```
___

### Analisando o código-fonte com PHPMD

* [PHP Mess Detector](https://phpmd.org/)

```sh
docker-compose exec -T php ./app/vendor/bin/phpmd ./app/src text cleancode,codesize,controversial,design,naming,unusedcode
```
___

### Verificando as extensões do PHP instaladas

```sh
docker-compose exec php php -m
```
___

## Manipulando o banco de dados

### Acesso ao MySQL

```sh
docker exec -it mysql bash
```

e

```sh
mysql -u "$MYSQL_ROOT_USER" -p"$MYSQL_ROOT_PASSWORD"
```
___

#### Criando um backup de todos os bancos de dados

```sh
mkdir -p data/db/dumps
```

```sh
source .env && docker exec $(docker-compose ps -q mysqldb) mysqldump --all-databases -u "$MYSQL_ROOT_USER" -p"$MYSQL_ROOT_PASSWORD" > "data/db/dumps/db.sql"
```
___

#### Restaurando um backup de todos os bancos de dados

```sh
source .env && docker exec -i $(docker-compose ps -q mysqldb) mysql -u "$MYSQL_ROOT_USER" -p"$MYSQL_ROOT_PASSWORD" < "data/db/dumps/db.sql"
```
___

#### Criando um backup de um único banco de dados

```sh
source .env && docker exec $(docker-compose ps -q mysqldb) mysqldump -u "$MYSQL_ROOT_USER" -p"$MYSQL_ROOT_PASSWORD" --databases YOUR_DB_NAME > "data/db/dumps/YOUR_DB_NAME_dump.sql"
```
___

#### Restaurando um backup de um único banco de dados

```sh
source .env && docker exec -i $(docker-compose ps -q mysqldb) mysql -u "$MYSQL_ROOT_USER" -p"$MYSQL_ROOT_PASSWORD" < "data/db/dumps/YOUR_DB_NAME_dump.sql"
```
