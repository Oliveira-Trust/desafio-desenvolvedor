# Desafio Desenvolvedor

API desenvolvida em Laravel 13 para ingestão de arquivos e consulta de market data, estruturada com uma organização inspirada em Domain-Driven Design. O projeto foi preparado para suportar upload assíncrono, processamento em background com Redis e Horizon, e exposição de contratos HTTP estáveis para consumo por frontend ou integrações.

## Visão Geral

O sistema está organizado em domínios de negócio, com separação clara entre camadas de apresentação, aplicação e componentes compartilhados. Atualmente, os principais contextos do projeto são:

- `Upload`, responsável pelo recebimento, rastreamento e processamento assíncrono de arquivos
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
- Vite

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
- jobs executam o processamento assíncrono em background
- componentes em `Shared` centralizam contratos de resposta, erros e comportamento transversal

## Autenticação

A API utiliza Laravel Sanctum com autenticação via Bearer Token.

JWT não foi adotado por adicionar complexidade desnecessária para este cenário, sendo mais útil em arquiteturas distribuídas.

No estado atual, o fluxo de autenticação já está funcional tanto na API quanto na interface web.

Atualmente, o fluxo de autenticação está exposto em:

```text
POST /api/auth/login
POST /api/auth/logout
```

O projeto também possui seed de usuário para ambiente local:

```text
email: test@example.com
senha: password
```

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
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
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
docker compose exec app php artisan queue:work redis --queue=ingestion
```

## Upload e Processamento Assíncrono

O fluxo de upload atualmente funciona da seguinte forma:

- `POST /api/uploads` recebe arquivos autenticados
- os formatos aceitos são `csv`, `xls` e `xlsx`
- o arquivo passa por validação de tamanho e extensão
- o sistema calcula o hash `md5` para impedir reenvio duplicado
- o arquivo é salvo localmente e um registro é criado na tabela `uploads`
- o job `ProcessUploadJob` é disparado para a fila `ingestion`

Durante o processamento:

- o upload é marcado como `processing`
- o arquivo é lido em streaming com OpenSpout
- as linhas são agrupadas em chunks de 1000 registros
- cada chunk gera um `ProcessUploadChunkJob`
- os jobs filhos fazem normalização mínima e `bulk insert` em `market_data`
- o progresso é atualizado com `processed_rows` e `failed_rows`
- ao final, o upload é concluído como `completed` ou `failed`

O histórico operacional pode ser consultado em:

```text
GET /api/uploads
```

Atualmente, esse endpoint suporta:

- paginação
- filtro por `filename`
- filtro por `date`

## Front-end

Além da API, o projeto já possui uma interface web básica para validação do fluxo principal:

- `/login`, para autenticação
- `/upload`, para envio de arquivos
- `/upload/history`, para acompanhamento do histórico de uploads

Essa interface consome a própria API e utiliza o token de autenticação gerado no login.

## Market Data

O endpoint atualmente exposto para consulta é:

```text
GET /api/market-data
```

No momento, a estrutura de persistência de `market_data` já existe, assim como o pipeline de ingestão para preenchimento da tabela. Porém, a busca final ainda está em evolução e o service atual responde com dados estáticos de exemplo.

Também já foram criados índices para suportar a evolução dessa consulta:

- índice composto em `market_data (tckr_symb, rpt_dt)`
- índice em `market_data (rpt_dt)`
- índice em `uploads (status, created_at)`

## Filas e Observabilidade

O projeto já está preparado para execução assíncrona com Redis e Horizon.

Atualmente, a solução inclui:

- fila dedicada `ingestion`
- job batching para coordenar chunks de processamento
- rastreamento de falhas por status do upload
- middleware de logging com `request_id`
- propagação de `X-Request-Id` nas respostas da API

Essa base permite acompanhar melhor requisições e processamentos, além de preparar o sistema para maior volume de arquivos.

## CI/CD

O repositório já possui pipeline de integração contínua em [`.github/workflows/ci.yml`](/var/www/html/projetos/desafio-desenvolvedor/.github/workflows/ci.yml).

Atualmente, o fluxo executa:

- checkout do código
- build e subida dos containers com Docker Compose
- espera ativa pela disponibilidade do MySQL
- instalação de dependências PHP
- preparação do ambiente Laravel
- execução de migrations
- execução dos testes automatizados
- instalação de dependências Node
- build dos assets frontend
- smoke test HTTP via Nginx

Na revisão atual, o comando abaixo foi validado localmente:

```bash
docker compose exec app php artisan test
```

Resultado atual:

```text
2 testes passaram
2 assertions
```

## Estado Atual e Próximos Passos

O sistema já possui uma base funcional para autenticação, upload, histórico e ingestão assíncrona. As próximas evoluções naturais do projeto incluem:

- concluir a busca real em `market_data` com filtros e paginação
- adicionar cache para consultas frequentes
- ampliar testes de negócio e testes de integração
- fortalecer políticas de retry, timeout e resiliência dos jobs
- expandir observabilidade operacional do pipeline
