# Desafio Desenvolvedor - Oliveira Trust


## Tecnologias utilizadas
- PHP 8.3
- Laravel 12
- Mongodb 
- Docker
- Docker Compose

## Requisitos

- Docker
- Docker Compose

## Como subir a aplicação

1. Acesse a pasta do projeto:

```sh
cd upload-php
```

2. Suba os containers:

```sh
bash up.sh
```

3. Após os containers estarem rodando, acesse o container da aplicação:

```sh
docker exec -it desafio-app bash
```

4. Execute os comandos abaixo dentro do container para configurar o ambiente:

```sh
php artisan key:generate
php artisan migrate
php artisan db:seed --class=UserSeeder --force
```

Pronto! A aplicação estará disponível nas portas configuradas no `docker-compose.yml`.


* Importe o arquivo `desafio.yaml` para testar os endpoints da aplicação.

## Endpoints principais

- Upload de arquivo: `POST /api/v1/uploads`
- Histórico de uploads: `GET /api/v1/uploads/history`
- Buscar conteúdo do arquivo: `GET /api/v1/search`
- Autenticação: `POST /api/v1/auth`

## Credenciais para autenticação
- Email: `moura@admin.com`
- Senha: `mouradev1`

