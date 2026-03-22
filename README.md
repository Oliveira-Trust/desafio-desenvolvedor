# Instruments API — Laravel 13

REST API para upload, processamento e consulta de arquivos de instrumentos financeiros da B3.

---

## Stack

- **PHP 8.4** + **Laravel 13**
- **MySQL** (banco principal)
- **Redis** (cache)
- **Laravel Sanctum** (autenticação via token)
- **Laravel Queues** (processamento assíncrono de arquivos)
- **OpenSpout** (leitura de XLSX/CSV em memória eficiente)
- **Docker** + **Docker Compose**

---

## Pré-requisitos

- Docker e Docker Compose instalados
- Git

---

## Subindo o projeto com Docker

### 1. Clone o repositório

```bash
git clone https://github.com/renancaldasdev/desafio-desenvolvedor/tree/renancaldascardosodasilva
cd renancaldascardosodasilva/laravel-api
```

### 2. Copie o arquivo de variáveis de ambiente

```bash
cp .env.example .env
```

### 3. Configure o `.env`

Edite o `.env` com as credenciais do banco e Redis:

```env
APP_NAME=InstrumentsAPI
APP_ENV=local
APP_KEY=                          # gerado no passo 5
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=instruments
DB_USERNAME=laravel
DB_PASSWORD=secret

CACHE_STORE=redis
REDIS_HOST=redis
REDIS_PORT=6379

QUEUE_CONNECTION=database

SESSION_DRIVER=database
```

### 4. Exemplo de `compose.yaml`

Crie na raiz do projeto um `compose.yaml`:

```yaml
services:
  app:
    build:
      context: ./laravel-api
      dockerfile: Dockerfile
    ports:
      - '8000:8000'
    volumes:
      - ./laravel-api:/var/www/html
    depends_on:
      - db
      - redis
    environment:
      - APP_ENV=local
    command: >
      sh -c "php artisan migrate --force &&
             php artisan serve --host=0.0.0.0 --port=8000"

  worker:
    build:
      context: ./laravel-api
      dockerfile: Dockerfile
    volumes:
      - ./laravel-api:/var/www/html
    depends_on:
      - db
      - redis
    command: php artisan queue:work --tries=3 --timeout=600

  db:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: instruments
      MYSQL_USER: laravel
      MYSQL_PASSWORD: secret
      MYSQL_ROOT_PASSWORD: root
    ports:
      - '3306:3306'
    volumes:
      - db_data:/var/lib/mysql

  redis:
    image: redis:7-alpine
    ports:
      - '6379:6379'

volumes:
  db_data:
```

### 5. Suba os containers

```bash
docker compose up -d
```

### 6. Gere a application key

```bash
docker compose exec app php artisan key:generate
```

### 7. Execute as migrations

```bash
docker compose exec app php artisan migrate
```

Pronto! A API estará disponível em `http://localhost:8000`.

---

## Executando sem Docker (local)

```bash
cd laravel-api

composer install

cp .env.example .env
# edite o .env com suas credenciais locais

php artisan key:generate
php artisan migrate

# Em terminais separados:
php artisan serve
php artisan queue:work --tries=3 --timeout=600
```

---

## Autenticação

A API utiliza **Laravel Sanctum** com tokens Bearer. Todos os endpoints (exceto register e login) exigem o header:

```
Authorization: Bearer {seu_token}
```

---

## Endpoints

### Auth

#### Registrar usuário

```
POST /api/auth/register
```

**Body (JSON):**

```json
{
  "name": "João Silva",
  "email": "joao@email.com",
  "password": "senha123",
  "password_confirmation": "senha123"
}
```

**Resposta 201:**

```json
{
  "message": "User registered successfully.",
  "user": {
    "id": 1,
    "name": "João Silva",
    "email": "joao@email.com",
    "created_at": "2024-08-22T10:00:00+00:00"
  },
  "token": "1|abc123..."
}
```

---

#### Login

```
POST /api/auth/login
```

**Body (JSON):**

```json
{
  "email": "joao@email.com",
  "password": "senha123"
}
```

**Resposta 200:**

```json
{
  "message": "Login successful.",
  "user": { ... },
  "token": "2|xyz456..."
}
```

> Rate limit: 10 requisições por minuto por IP.

---

#### Dados do usuário autenticado

```
GET /api/me
Authorization: Bearer {token}
```

---

#### Logout

```
POST /api/logout
Authorization: Bearer {token}
```

---

### Upload de Arquivos

#### Enviar arquivo

```
POST /api/files/upload
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Parâmetros:**

| Campo | Tipo | Obrigatório | Descrição                             |
| ----- | ---- | ----------- | ------------------------------------- |
| file  | file | Sim         | Arquivo CSV, XLSX ou XLS (máx. 200MB) |

**Resposta 202:**

```json
{
  "status": "success",
  "message": "Arquivo aceito e enfileirado para processamento.",
  "upload": {
    "original_name": "InstrumentsConsolidatedFile_20240822_20240827.xlsx",
    "stored_name": "uploads/abc123.xlsx",
    "status": "pending",
    "reference_date": "2024-08-22"
  }
}
```

> O arquivo é processado de forma **assíncrona** via fila. Acompanhe o status pelo histórico.

**Regras:**

- Formatos aceitos: `csv`, `xlsx`, `xls`
- Tamanho máximo: 200MB
- O mesmo arquivo **não pode ser enviado duas vezes** (verificado por hash SHA-256)
- A data de referência é extraída automaticamente do nome do arquivo (padrão: `YYYYMMDD`)

---

#### Histórico de uploads

```
GET /api/files/history
Authorization: Bearer {token}
```

**Query params opcionais:**

| Parâmetro      | Tipo   | Exemplo     | Descrição                          |
| -------------- | ------ | ----------- | ---------------------------------- |
| name           | string | Instruments | Busca parcial pelo nome do arquivo |
| reference_date | date   | 2024-08-22  | Filtra pela data de referência     |

**Exemplo:**

```
GET /api/files/history?reference_date=2024-08-22
```

**Resposta 200:**

```json
{
  "data": [
    {
      "original_name": "InstrumentsConsolidatedFile_20240822_20240827.xlsx",
      "stored_name": "uploads/abc123.xlsx",
      "status": "done",
      "reference_date": "2024-08-22"
    }
  ],
  "meta": {
    "current_page": 1,
    "per_page": 15,
    "total": 1,
    "last_page": 1
  }
}
```

**Status possíveis:** `pending` | `processing` | `done` | `failed`

---

### Instrumentos

#### Buscar instrumentos

```
GET /api/instruments
Authorization: Bearer {token}
```

**Query params opcionais:**

| Parâmetro | Tipo   | Exemplo    | Descrição                       |
| --------- | ------ | ---------- | ------------------------------- |
| TckrSymb  | string | AMZO34     | Código do ticker do instrumento |
| RptDt     | date   | 2024-08-26 | Data do relatório (YYYY-MM-DD)  |

**Exemplos:**

```
GET /api/instruments
GET /api/instruments?TckrSymb=AMZO34
GET /api/instruments?RptDt=2024-08-26
GET /api/instruments?TckrSymb=AMZO34&RptDt=2024-08-26
```

**Resposta 200:**

```json
{
  "data": [
    {
      "RptDt": "2024-08-26",
      "TckrSymb": "AMZO34",
      "MktNm": "EQUITY-CASH",
      "SctyCtgyNm": "BDR",
      "ISIN": "BRAMZOBDR002",
      "CrpnNm": "AMAZON.COM, INC"
    }
  ],
  "meta": {
    "current_page": 1,
    "per_page": 50,
    "total": 1,
    "last_page": 1
  }
}
```

**Comportamento da paginação:**

- Sem parâmetros: retorna **50 registros** por página
- Com filtros: retorna até **500 registros** por página
- Resultados são **cacheados por 30 minutos** no Redis

---

## Exemplo de fluxo completo (cURL)

```bash
# 1. Registrar
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{"name":"Dev","email":"dev@test.com","password":"senha123","password_confirmation":"senha123"}'

# 2. Login e obter token
TOKEN=$(curl -s -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"dev@test.com","password":"senha123"}' | jq -r '.token')

# 3. Upload de arquivo
curl -X POST http://localhost:8000/api/files/upload \
  -H "Authorization: Bearer $TOKEN" \
  -F "file=@/caminho/para/arquivo.xlsx"

# 4. Consultar instrumentos
curl "http://localhost:8000/api/instruments?TckrSymb=AMZO34" \
  -H "Authorization: Bearer $TOKEN"
```

---

## Comandos úteis

```bash
# Logs da aplicação
docker compose exec app php artisan pail

# Rodar testes
docker compose exec app php artisan test

# Limpar cache
docker compose exec app php artisan cache:clear

# Ver status das filas
docker compose exec app php artisan queue:monitor database:default
```

---

## Fonte dos arquivos de teste

Arquivos diários de instrumentos da B3 (~75.000 linhas) disponíveis em:

> https://www.b3.com.br/pt_br/market-data-e-indices/servicos-de-dados/market-data/consultas/boletim-diario/dados-publicos-de-produtos-listados-e-de-balcao/

Selecione uma data → _Cadastro de Instrumentos (Listado)_ → _Baixar arquivo_
