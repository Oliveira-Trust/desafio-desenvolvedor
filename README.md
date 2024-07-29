
# Desafio Laravel Exchange

Este projeto é uma aplicação Laravel utilizando Laravel Sail para um ambiente de desenvolvimento Docker. A aplicação inclui uma página personalizada criada com Filament.

## Pré-requisitos

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Configuração do Projeto

### Clonando o Repositório

```bash
git clone https://github.com/HigorJSilva/desafio-desenvolvedor
cd desafio-desenvolvedor/currency-exchange
```
### Instalando Dependências

Certifique-se de ter o Composer instalado em seu sistema.

```bash
composer install
```

### Configurando o Ambiente

Copie o arquivo `.env.example` para `.env` e ajuste as configurações conforme necessário.

```bash
cp .env.example .env
```
### Subindo o Sail

Laravel Sail fornece um ambiente Docker para desenvolvimento. Para iniciar os containers do Sail, execute o seguinte comando:

```bash
./vendor/bin/sail up -d
```
### Executando Migrations e Seeds

Para configurar o banco de dados com as tabelas e dados iniciais, execute as migrations e seeds:

```bash
./vendor/bin/sail artisan migrate --seed
```
## Acessando a Aplicação

Após subir o Sail e realizar as migrations e seeds, a aplicação estará acessível no endereço:
```bash
http://localhost/app
```
### Acessando a aplicação

Você poderá usar o usuário criado no seed (usuário: admin@oliveiratrust.com.br senha: admin) ou criar um na tela de login, caso o usuário criado possua em seu email o domínio `@oliveiratrust.com.br`ele será tratado como admin e terá acesso ao modulo de taxas