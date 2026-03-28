# Laravel + MongoDB + Redis + Docker

Projeto Laravel usando MongoDB, Redis e Horizon, tudo em containers Docker, com build de assets via Vite.

## Requisitos

- [Docker](https://docs.docker.com/get-docker/) (20.10+)
- [Docker Compose](https://docs.docker.com/compose/install/) (2.0+)

## Inicialização rápida (Docker)

1) Copie o arquivo de ambiente:
```bash
cp .env.example .env
```

2) Rode o script de setup (dependências + build de assets + permissões):
```bash
chmod +x setup.sh
./setup.sh
```

## Serviços e portas

- **Aplicação Laravel**: `http://localhost`
- **Mongo Express**: `http://localhost:8081`
- **MongoDB**: `localhost:27017`
- **Redis**: `localhost:6379`

## O que o setup faz

O `setup.sh`:
- constrói a imagem `laravel_builder`;
- instala dependências PHP e JS;
- compila os assets (`npm run build`);
- ajusta permissões de `storage/` e `bootstrap/cache`.

## Comandos úteis

- Logs do app: `docker compose logs -f app`
- Parar: `docker compose down`
- Reiniciar: `docker compose restart`
- Artisan no container: `docker compose exec app php artisan <comando>`
- Testes: `docker compose exec app php artisan test`

## Solução de problemas

### Permissão nos logs
Se aparecer `Failed to open stream: Permission denied`, rode novamente:
```bash
./setup.sh
```

### Container não sobe
Verifique os logs com `docker compose logs` e confirme `.env` criado.
# Laravel + MongoDB + Redis + Docker

Projeto Laravel usando MongoDB, Redis e Horizon, tudo em containers Docker, com build de assets via Vite.

## Requisitos

- [Docker](https://docs.docker.com/get-docker/) (20.10+)
- [Docker Compose](https://docs.docker.com/compose/install/) (2.0+)

## Inicialização rápida (Docker)

1) Copie o arquivo de ambiente:
```bash
cp .env.example .env
```

2) Rode o script de setup (dependências + build de assets + permissões):
```bash
chmod +x setup.sh
./setup.sh
```

3) Suba os containers:
```bash
docker compose up -d
```

## Serviços e portas

- **Aplicação Laravel**: `http://localhost:8080` (ou `APP_PORT` no `.env`)
- **Mongo Express**: `http://localhost:8081`
- **MongoDB**: `localhost:27017`
- **Redis**: `localhost:6379`

## O que o setup faz

O `setup.sh`:
- constrói a imagem `laravel_builder`;
- instala dependências PHP e JS;
- compila os assets (`npm run build`);
- ajusta permissões de `storage/` e `bootstrap/cache`.

## Comandos úteis

- Logs do app: `docker compose logs -f app`
- Parar: `docker compose down`
- Reiniciar: `docker compose restart`
- Artisan no container: `docker compose exec app php artisan <comando>`
- Testes: `docker compose exec app php artisan test`

## Solução de problemas

### Permissão nos logs
Se aparecer `Failed to open stream: Permission denied`, rode novamente:
```bash
./setup.sh
```

### Container não sobe
Verifique os logs com `docker compose logs` e confirme `.env` criado.
