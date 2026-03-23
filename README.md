# Desafio Desenvolvedor

API em Laravel 13 para autenticacao stateful, ingestao assincrona de arquivos e consulta de market data. O projeto combina backend HTTP, jobs em fila, cache Redis e uma interface web simples para validar o fluxo principal de ponta a ponta.

## Visao Geral

O codigo esta organizado em dominios inspirados em DDD:

- `User`: autenticacao e sessao stateful com Laravel Sanctum
- `Upload`: recebimento do arquivo, persistencia do upload e orquestracao do processamento assincrono
- `MarketData`: consulta dos dados processados com filtros e paginacao
- `Shared`: respostas HTTP, erros e componentes transversais

Principais capacidades ja implementadas:

- login e logout stateful por cookie de sessao
- protecao CSRF para requisicoes mutaveis
- upload autenticado com prevencao de duplicidade por `md5`
- processamento em background com Redis, batch e chunking
- persistencia de progresso, falhas e `reference_date`
- consulta paginada de uploads com filtros
- consulta paginada de market data com filtros e cache seletivo
- observabilidade com `request_id`, logs estruturados e rastreamento de falhas
- interface web para login, upload, historico e consulta de market data

## Stack

- PHP 8.3
- Laravel 13
- MySQL 8
- Redis
- Laravel Sanctum
- Laravel Horizon
- OpenSpout
- PhpSpreadsheet
- Docker Compose
- Vite

## Arquitetura

```text
app/
  Domains/
    MarketData/
    Upload/
    User/
  Shared/
app/Jobs/
resources/views/
routes/
```

Papeis principais:

- controllers orquestram o contrato HTTP
- form requests validam e normalizam entrada
- services concentram regras de aplicacao
- jobs processam o pipeline de ingestao em background
- Eloquent models fazem a integracao com persistencia
- `Shared` centraliza envelopes de sucesso e erro

Fluxo principal:

1. o cliente executa `GET /sanctum/csrf-cookie`
2. o cliente faz login em `POST /api/auth/login`
3. o cliente envia um arquivo para `POST /api/uploads`
4. `UploadService` valida duplicidade, salva o arquivo e despacha `ProcessUploadJob`
5. `ProcessUploadJob` valida o header, extrai `reference_date` e divide as linhas em chunks
6. `ProcessUploadChunkJob` persiste market data valida e atualiza progresso
7. `GET /api/uploads` expoe o historico operacional
8. `GET /api/market-data` expoe consultas paginadas sobre os dados processados

## Contratos HTTP

Respostas de sucesso seguem este envelope:

```json
{
  "data": {},
  "meta": {},
  "message": "Opcional"
}
```

Respostas de erro seguem este envelope:

```json
{
  "error": {
    "code": "VALIDATION_ERROR",
    "message": "Descricao do erro",
    "details": {}
  },
  "trace_id": "uuid-ou-request-id"
}
```

Comportamentos transversais:

- `X-Request-Id` recebido na requisicao e propagado para a resposta
- `request_id` incluido no `meta` de `POST /api/uploads`
- validacoes retornam `422`
- rotas protegidas retornam `401`
- rate limit retorna `429`
- mismatch de CSRF retorna `419` com payload estruturado

## Autenticacao

O projeto usa Laravel Sanctum em modo stateful. Nao ha Bearer token proprio da aplicacao: o cliente reutiliza cookie de sessao e token CSRF.

Endpoints:

- `GET /sanctum/csrf-cookie`
- `POST /api/auth/login`
- `POST /api/auth/logout`

Detalhes atuais:

- autenticacao via `Auth::guard('web')`
- normalizacao do email no `LoginRequest`
- regeneracao de sessao no login
- invalidacao de sessao e regeneracao de token CSRF no logout
- throttle de login com limite por email + IP

Usuario seed local:

```text
email: test@example.com
password: password
```

## API

### Uploads

Rotas:

- `POST /api/uploads`
- `GET /api/uploads`

`POST /api/uploads`:

- exige autenticacao Sanctum
- aceita `csv`, `xls` e `xlsx`
- limite de 78 MB
- impede reenvio duplicado por `file_md5`
- retorna `202 Accepted`
- inclui `message`, `data.upload` e `meta.request_id`

Campos relevantes de retorno do upload:

- `id`
- `filename`
- `path`
- `mime_type`
- `size`
- `status`
- `rows_total`
- `processed_rows`
- `failed_rows`
- `reference_date`
- `error_message`
- `created_at`

`GET /api/uploads`:

- exige autenticacao Sanctum
- suporta `per_page` de 1 a 100
- suporta filtro por `filename`
- suporta filtro por `date` no formato `Y-m-d`
- o filtro `date` usa `reference_date`, nao `created_at`
- retorna payload paginado em `meta`

### Market Data

Rota:

- `GET /api/market-data`

Comportamento atual:

- exige autenticacao Sanctum
- suporta filtros `TckrSymb` e `RptDt`
- normaliza ticker para uppercase e remove espacos/caracteres de controle
- suporta `page` e `per_page`
- retorna payload paginado mesmo quando filtros sao aplicados
- ordena por `rpt_dt desc` e `tckr_symb`
- cacheia apenas consultas sem filtros por 5 minutos
- invalida o cache ao concluir ingestao com sucesso

Campos de retorno:

- `RptDt`
- `TckrSymb`
- `MktNm`
- `SctyCtgyNm`
- `ISIN`
- `CrpnNm`

## Pipeline de Ingestao

O processamento assincrono usa `ProcessUploadJob` e `ProcessUploadChunkJob`, ambos na fila `ingestion`.

Capacidades atuais:

- leitura de `csv` com delimitador `;`
- leitura de `xlsx` com OpenSpout
- leitura de `xls` com PhpSpreadsheet
- validacao de header em posicoes fixas
- suporte ao header minimo:
  - `RptDt[0]`
  - `TckrSymb[1]`
  - `MktNm[5]`
  - `SctyCtgyNm[6]`
  - `ISIN[15]`
  - `CrpnNm[47]`
- ignorar linha `Status do Arquivo:` e linhas vazias
- extracao da `reference_date` a partir da primeira linha de dados valida
- divisao em chunks de 1000 linhas
- dispatch em batch para coordenar chunks
- insercao em lote em `market_data`
- atualizacao incremental de `processed_rows` e `failed_rows`
- guarda de concorrencia para nao reprocessar upload que ja saiu de `pending`
- idempotencia por `upload_id + chunk_index`
- persistencia de falhas em `failed_jobs`
- retry com backoff para falhas transitarias

Estados de upload utilizados:

- `pending`
- `processing`
- `completed`
- `failed`

## Observabilidade e Seguranca

Observabilidade:

- middleware de logging com `request_id`
- logs estruturados para inicio e fim de requisicoes
- logs estruturados para jobs de upload e chunk
- correlacao entre request HTTP e jobs assicronos
- persistencia de falhas finais na tabela `failed_jobs`

Seguranca operacional:

- rotas de dados protegidas por `auth:sanctum`
- protecao CSRF para login, logout e upload
- rate limits:
  - login: 5 por minuto
  - uploads: 3 por minuto e 25 por dia
  - historico de uploads: 30 por minuto
  - market data: 5 por minuto e 100 por hora

## Frontend

A aplicacao possui paginas Blade para validar o fluxo principal:

- `/login`
- `/upload`
- `/upload/history`
- `/market-data`

As telas usam a mesma autenticacao stateful do backend.

## Banco de Dados

Tabelas principais:

- `users`
- `uploads`
- `market_data`
- `upload_processed_chunks`
- `jobs`
- `job_batches`
- `failed_jobs`

Indices e otimizacoes relevantes:

- indice composto para busca de market data por ticker e data
- indice em `uploads.reference_date`
- indice em status e timestamps de uploads

## Execucao Local

```bash
cp .env.example .env
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --force
docker compose exec app php artisan db:seed --force
docker compose exec app npm install
docker compose exec app npm run build
```

Aplicacao local:

```text
http://localhost:8000
```

## Comandos Uteis

```bash
docker compose ps
docker compose exec app php artisan test
docker compose exec app php artisan queue:work redis --queue=ingestion
docker compose exec app php artisan horizon
docker compose exec app php artisan migrate:status
docker compose exec app php artisan tinker
```

Invalidar cache de market data:

```bash
docker compose exec app php artisan tinker --execute='app(App\Domains\MarketData\Application\Services\MarketDataService::class)->invalidateCache();'
```

## Testes

A suite cobre cenarios de unit e feature test:

- autenticacao stateful com Sanctum
- payload estruturado para CSRF mismatch
- validacao de upload e aceite de `xls`
- correlacao de `request_id`
- persistencia de `reference_date`
- validacao de schema/header do arquivo
- leitura de arquivos `xls`
- guarda de concorrencia no upload
- idempotencia de chunks
- classificacao de falhas transitarias
- registro em `failed_jobs`
- paginacao, filtros e cache de market data

Execucao local:

```bash
docker compose exec app php artisan test
```

## Postman

Os artefatos de API para uso manual estao em:

- [postman/collection.json](/var/www/html/projetos/desafio-desenvolvedor/postman/collection.json)
- [postman/environment.local.json](/var/www/html/projetos/desafio-desenvolvedor/postman/environment.local.json)
- [postman/README.md](/var/www/html/projetos/desafio-desenvolvedor/postman/README.md)

A collection cobre:

- bootstrap do cookie CSRF
- login e logout stateful
- upload com `X-Request-Id`
- historico de uploads com e sem filtros
- market data com consultas padrao e filtradas

## CI

O pipeline de CI fica em [`.github/workflows/ci.yml`](/var/www/html/projetos/desafio-desenvolvedor/.github/workflows/ci.yml) e prepara containers, ambiente Laravel, banco principal, banco de testes, seed local, testes automatizados e build dos assets frontend.
