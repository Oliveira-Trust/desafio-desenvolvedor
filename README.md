# Desafio Desenvolvedor

API desenvolvida em Laravel 13 para ingestão de arquivos e consulta de market data, estruturada com uma organização inspirada em Domain-Driven Design. O projeto suporta upload assíncrono, processamento em background com Redis, consulta paginada de market data com cache e contratos HTTP estáveis para consumo por frontend ou integrações.

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

Fluxo principal de ponta a ponta:

1. o cliente autentica em `POST /api/auth/login`
2. o cliente envia um arquivo para `POST /api/uploads`
3. `UploadService` valida duplicidade por `file_md5`, persiste o upload e despacha `ProcessUploadJob`
4. `ProcessUploadJob` lê o arquivo, valida header, extrai `reference_date`, agrupa linhas em chunks e cria `ProcessUploadChunkJob`
5. os chunks processam linhas válidas e fazem `bulk insert` em `market_data`
6. o upload é atualizado com `rows_total`, `processed_rows`, `failed_rows`, `status` e `error_message`
7. `GET /api/uploads` expõe o histórico operacional
8. `GET /api/market-data` expõe a busca paginada com cache para consultas sem filtro de ticker

## Autenticação

A aplicação utiliza Laravel Sanctum no modo stateful, com autenticação por cookie de sessão e proteção CSRF para o frontend web.

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
docker compose exec app php artisan migrate:status
docker compose exec app php artisan tinker
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
- o arquivo é lido em streaming com OpenSpout para `csv`, `xlsx` e `ods`
- arquivos `xls` são lidos com PhpSpreadsheet
- as linhas são agrupadas em chunks de 1000 registros
- cada chunk gera um `ProcessUploadChunkJob`
- os jobs filhos fazem normalização mínima, descartam linhas inválidas e executam `bulk insert` em `market_data`
- o sistema evita reprocessamento indevido com guarda de concorrência no upload e idempotência por `upload_id + chunk_index`
- o progresso é atualizado com `rows_total`, `processed_rows` e `failed_rows`
- ao final, o upload é concluído como `completed` ou `failed`

O histórico operacional pode ser consultado em:

```text
GET /api/uploads
```

Atualmente, esse endpoint suporta:

- paginação
- filtro por `filename`
- filtro por `date`, aplicado sobre `reference_date`

## Front-end

Além da API, o projeto já possui uma interface web básica para validação do fluxo principal:

- `/login`, para autenticação
- `/upload`, para envio de arquivos
- `/upload/history`, para acompanhamento do histórico de uploads

Essa interface consome a própria API usando a sessão autenticada do Sanctum.

## Market Data

O endpoint atualmente exposto para consulta é:

```text
GET /api/market-data
```

Esse endpoint já realiza busca real sobre `market_data`, com os comportamentos abaixo:

- paginação padrão quando não há filtro de ticker
- filtro por `TckrSymb`
- filtro por `RptDt`
- normalização de ticker para busca
- cache para consultas sem filtro de ticker
- invalidação do cache após conclusão de processamento de upload

Também já foram criados índices para suportar a evolução dessa consulta:

- índice composto em `market_data (tckr_symb, rpt_dt)`
- índice em `market_data (rpt_dt)`
- índice em `uploads (status, created_at)`
- índice em `uploads (reference_date)`

## Filas e Observabilidade

O projeto já está preparado para execução assíncrona com Redis e Horizon.

Atualmente, a solução inclui:

- fila dedicada `ingestion`
- job batching para coordenar chunks de processamento
- rastreamento de falhas por status do upload
- middleware de logging com `request_id`
- propagação de `X-Request-Id` nas respostas da API
- logs estruturados com `request_id`, `upload_id`, `chunk`, `status`, `attempt` e `duration_ms`
- persistência de falhas em `failed_jobs`
- retry/backoff para falhas transitórias
- rate limit em login, upload, histórico e market data

Essa base permite acompanhar melhor requisições e processamentos, além de preparar o sistema para maior volume de arquivos.

## Trade-offs

### MySQL vs NoSQL

- MySQL foi escolhido porque o problema principal é ingestão tabular com filtros bem definidos por data, ticker e paginação.
- O modelo relacional simplifica índices, consistência e consultas operacionais do histórico de uploads.
- NoSQL faria mais sentido se o domínio exigisse esquema altamente variável, escrita distribuída extrema ou acesso orientado a documentos, o que não é o foco atual.

### Redis vs cache simples

- Redis foi escolhido porque o projeto já depende de fila assíncrona e se beneficia de uma camada compartilhada para cache e queue backend.
- Um cache simples em arquivo ou array seria suficiente apenas para ambiente local ou cenários com baixo volume.
- Redis melhora invalidação, throughput e aderência ao ambiente de produção, ao custo de mais uma dependência operacional.

### Sanctum vs JWT

- Sanctum foi escolhido por simplicidade e integração nativa com Laravel.
- JWT adicionaria mais complexidade de emissão, revogação e rotação sem ganho proporcional para este cenário.
- Para uma API monolítica com frontend próprio e autenticação stateful/stateless controlada, Sanctum atende melhor com menos custo operacional.

### Paralelismo vs simplicidade

- O pipeline usa paralelismo por chunks porque arquivos grandes exigem processamento assíncrono e divisão de trabalho para manter throughput.
- Um fluxo totalmente sequencial seria mais simples de entender, mas aumentaria o tempo total de ingestão e o risco de gargalo em arquivos grandes.
- O custo do paralelismo é a necessidade de controles extras de idempotência, batching, retry e observabilidade, que já foram incorporados ao projeto.

## Runbook

### Subida do ambiente

```bash
cp .env.example .env
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```

### Verificações rápidas de saúde

```bash
docker compose ps
docker compose exec app php artisan migrate:status
docker compose exec app php artisan test
```

Sinais esperados:

- `mysql`, `redis`, `app` e `nginx` em estado `Up`
- migrations aplicadas
- suíte de testes verde

### Operação de fila

Para consumir a fila localmente:

```bash
docker compose exec app php artisan queue:work redis --queue=ingestion --tries=1
```

Para observar backlog da fila `ingestion`:

```bash
docker compose exec app php artisan tinker --execute='use Illuminate\Support\Facades\Redis; echo json_encode(["queue_len" => Redis::llen("queues:ingestion"), "reserved_len" => Redis::llen("queues:ingestion:reserved"), "delayed_len" => Redis::zcard("queues:ingestion:delayed")], JSON_UNESCAPED_UNICODE), PHP_EOL;'
```

Interpretação:

- `queue_len > 0` indica backlog aguardando consumo
- `reserved_len > 0` indica jobs atualmente reservados por workers
- `delayed_len > 0` indica jobs em retry/backoff

### Diagnóstico de falhas

Para verificar uploads com erro:

```bash
docker compose exec app php artisan tinker --execute='echo App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload::query()->where("status", "failed")->latest("id")->limit(10)->get(["id", "filename", "status", "error_message"])->toJson(JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE), PHP_EOL;'
```

Para verificar falhas persistidas da fila:

```bash
docker compose exec app php artisan tinker --execute='echo Illuminate\Support\Facades\DB::table("failed_jobs")->latest("id")->limit(10)->get()->toJson(JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE), PHP_EOL;'
```

### Limpeza de cache de busca

```bash
docker compose exec app php artisan tinker --execute='app(App\Domains\MarketData\Application\Services\MarketDataService::class)->invalidateCache();'
```

### Evidências já validadas

- unit tests para `UploadService` e `MarketDataService`
- feature tests para upload, histórico, busca, autenticação e fluxo assíncrono
- smoke de latência com diferença clara entre cold e warm cache
- smoke de backlog de fila sob carga
- simulação de ingestão com arquivo CSV real de 16 MB

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
suíte ampliada com cobertura de unit e feature tests
```

## Estado Atual e Próximos Passos

O sistema já possui uma base funcional para autenticação, upload, histórico, ingestão assíncrona e busca paginada com cache. As próximas evoluções naturais do projeto incluem:

- reduzir o volume de linhas descartadas no processamento do arquivo bruto
- formalizar benchmarks repetíveis de carga
- expandir métricas operacionais do pipeline
- revisar estratégia de particionamento e tuning de banco para volume maior
- endurecer o fluxo web stateful de login/logout no ambiente local
