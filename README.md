# Desafio Desenvolvedor

API desenvolvida em Laravel 13 para ingestão de arquivos e consulta de market data, estruturada com uma organização inspirada em Domain-Driven Design. O projeto foi preparado para suportar upload assíncrono, processamento em background com Redis e Horizon, e exposição de contratos HTTP estáveis para consumo por frontend ou integrações.

## Visão Geral

O sistema está organizado em domínios de negócio, com separação clara entre camadas de apresentação, aplicação e componentes compartilhados. Atualmente, os principais contextos do projeto são:

- `Upload`, responsável pelo recebimento e rastreamento inicial de arquivos
- `MarketData`, responsável pela exposição dos dados consultáveis
- `User`, responsável pelo fluxo de autenticação

Além dos domínios, a aplicação possui uma camada compartilhada para resposta padronizada, tratamento de erros e observabilidade básica de requisições.

## Stack Tecnológica

- PHP 8.3
- Laravel 13
- Docker
- MySQL 8
- Redis
- Laravel Sanctum
- Laravel Horizon
- OpenSpout
- Predis

## Arquitetura

A estrutura do código segue a divisão abaixo:

```text
app/
  Domains/
    Upload/
    MarketData/
    User/
  Shared/
```

Nessa organização:

- controllers atuam como camada de orquestração HTTP
- services concentram o fluxo de aplicação
- requests encapsulam validação de entrada
- componentes em `Shared` centralizam contratos de resposta, erros e comportamento transversal

## Autenticação

A API utiliza Laravel Sanctum com autenticação via Bearer Token.

JWT não foi adotado por adicionar complexidade desnecessária para este cenário, sendo mais útil em arquiteturas distribuídas.

## Ambiente de Execução

O ambiente local é composto por quatro serviços principais:

- `app`, responsável pela aplicação Laravel
- `nginx`, responsável pela exposição HTTP
- `mysql`, responsável pela persistência relacional
- `redis`, responsável por cache e filas

Por padrão, a aplicação fica disponível em:

```text
http://localhost:8000
```

O Redis já está preparado para uso com filas e cache por meio das variáveis abaixo:

```env
QUEUE_CONNECTION=redis
CACHE_STORE=redis
REDIS_CLIENT=predis
REDIS_HOST=redis
```

## Execução Local

Para iniciar o projeto localmente:

```bash
cp .env.example .env
docker compose up -d
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

Caso a interface frontend precise ser compilada:

```bash
docker compose exec app npm install
docker compose exec app npm run build
```

## Operação

Comandos úteis no ambiente local:

```bash
docker compose up -d
docker compose exec app php artisan test
docker compose exec app php artisan horizon
```
