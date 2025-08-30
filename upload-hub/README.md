# API de Upload de Arquivos  - Desavio Desenvolvedor (Oliveira Trust)

> Este projeto foi desenvolvido como **desafio para desenvolvedor**. O objetivo foi criar uma aplicação Laravel completa, integrando MySQL, MongoDB, Redis, Nginx e Docker, com suporte a uploads, filas e endpoints de API.

## 📖 Descrição do Projeto

Este projeto é uma aplicação web desenvolvida em Laravel que permite
- **Gerenciar upload de arquivos**
- **Processar dados em backgound utilizando fila(Redis) e jobs**
- **Armazenar dados estruturados em MySQL e dados orientados a documentos em MongoDB**
- **Expor endpoind de API para envio do arquivo, histórico de arquivos, busca de dados processados e autenticação**

A aplicação também inclui:

- Controle de autenticação e permissões de usuários com **Sanctum**.
- Configuração de ambiente utilizando Docker Compose para MySQL, MongoDB, Redis e Nginx. 

## 📚 Tecnologias utilizadas

- **Backend:** Laravel 12
- **Banco de Dados:**
  - MySQL
  - MongoDB 
- **Cache/Queue:** Redis
- **Web Server:** Nginx
- **Docker & Docker Compose** para ambiente de desenvolvimento

## 🛠 Pré-requisitos
- Docker 20+ e Docker Compose  

## 🚀 Configuração do ambiente
1. Clone o repositório:

```bash
git clone https://github.com/cintiaribeiro/desafio-desenvolvedor
cd upload-hub
```

2. Copie o .env e configure variáveis de ambiente:
```
cp .env.example .env
```

3. Copie o .env e configure variáveis de ambiente:
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel

MONGO_DB_URI=mongodb://mongodb:27017/processed_files

REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PORT=6379
```
## 📦 Rodando o projeto via Docker

1. Build e start dos containers:

```bash
docker-compose up -d --build
```

2. Execute migrations e seeders (MySQL):

```bash
    docker exec -it laravel_app php artisan migrate --seed

```

##⚡ Fila e Jobs

```bash
docker exec -it laravel_app php artisan queue:work

```

## 📦 Endpoints da API - Exemplos de Uso

### 1. Login

**POST /api/login**

**Request:**

```json
{
  "email": "user@example.com",
  "password": "senha123"
}
```

```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"senha123"}'
```

**Response:**

```bash
{
  "message": "Login successful",
  "user": {
    "id": 11,
    "name": "Sally McKenzie",
    "email": "test@example.com",
    "email_verified_at": "2025-08-29T22:49:17.000000Z",
    "created_at": "2025-08-29T22:49:17.000000Z",
    "updated_at": "2025-08-29T22:49:17.000000Z"
  },
  "token": "9|jgPvFyrJ7MA3ndnKAKDxhTkmeL9r64JZjKS5R7jHff6b910f"
}
```

2. Upload de arquivo

POST /api/upload

Headers: Authorization: Bearer <token>

Form-data: file (CSV ou Excel)

**Request:**
```bash
curl --request POST \
  --url http://localhost:8000/api/v1/uploads \
  --header 'accept: application/json' \
  --header 'authorization: Bearer 9|jgPvFyrJ7MA3ndnKAKDxhTkmeL9r64JZjKS5R7jHff6b910f' \
  --header 'content-type: multipart/form-data' \
  --form 'file=@C:\arquivo.csv'
```

**Response:**
```bash
    {
  "data": {
    "id": 54,
    "original_name": "arquivo.csv",
    "path": "uploads/arquivo.csv",
    "user_id": "Sally McKenzie",
    "status": "Pending",
    "created_at": "2025-08-30T08:07:50.000000Z",
    "updated_at": "2025-08-30T08:07:50.000000Z"
  },
  "message": "File uploaded successfully"
}
```

3. Historico arquivos
> Busca por date e original_name

GET /api/files 

Headers: Authorization: Bearer <token>

**Request:**
```bash
curl --request GET \
  --url http://localhost:8000/api/v1/uploads/history \
  --header 'accept: application/pdf' \
  --header 'authorization: Bearer 9|jgPvFyrJ7MA3ndnKAKDxhTkmeL9r64JZjKS5R7jHff6b910f' \
  --header 'content-type: application/json' \
  --data '{
  "date": "2025-08-30"
}'
```

**Response**
```bash
{
  "data": [
    {
      "id": 54,
      "original_name": "    "path": "uploads/arquivo.csv",
.csv",
      "path": "uploads/    "path": "uploads/arquivo.csv",
.csv",
      "user_id": "Sally McKenzie",
      "rows_expected": null,
      "rows_processed": null,
      "status": "Processing",
      "created_at": "2025-08-30T08:07:50.000000Z",
      "updated_at": "2025-08-30T08:08:02.000000Z"
    }
  ]
}
```
4. Detalhes de um arquivo
> Busca por TckrSymb e RptDt

GET /api/files/{id}

Headers: Authorization: Bearer <token>

**Request**
```bash
curl --request GET \
  --url http://localhost:8000/api/v1/search \
  --header 'accept: application/pdf' \
  --header 'authorization: Bearer 9|jgPvFyrJ7MA3ndnKAKDxhTkmeL9r64JZjKS5R7jHff6b910f' \
  --header 'content-type: application/json'
```

**Response**
```bash
{
  "data": [
    {
      "RptDt": "2024-08-23",
      "TckrSymb": "003H11",
      "MktNm": "EQUITY-CASH",
      "SctyCtgyNm": "FUNDS",
      "ISIN": "BR003HCTF006",
      "CrpnNm": "KINEA CO-INVESTIMENTO FDO INV IMOB"
    },
    {
      "RptDt": "2024-08-23",
      "TckrSymb": "0FEA11",
      "MktNm": "EQUITY-CASH",
      "SctyCtgyNm": "FUNDS",
      "ISIN": "BR0FEACTF006",
      "CrpnNm": "SPIM FUNDO DE INVESTIMENTO IMOBILI�RIO"
    },
    {
      "RptDt": "2024-08-23",
      "TckrSymb": "2WAV3",
      "MktNm": "EQUITY-CASH",
      "SctyCtgyNm": "SHARES",
      "ISIN": "BR2WAVACNOR8",
      "CrpnNm": "2W ECOBANK S.A."
    },
    {
      "RptDt": "2024-08-23",
      "TckrSymb": "A1AP34",
      "MktNm": "EQUITY-CASH",
      "SctyCtgyNm": "BDR",
      "ISIN": "BRA1APBDR001",
      "CrpnNm": "ADVANCE AUTO PARTS INC"
    },
    {
      "RptDt": "2024-08-23",
      "TckrSymb": "A1AP34M",
      "MktNm": "EQUITY-CASH",
      "SctyCtgyNm": "BDR",
      "ISIN": "BRA1APBDR001",
      "CrpnNm": "ADVANCE AUTO PARTS INC"
    },
    {
      "RptDt": "2024-08-23",
      "TckrSymb": "A1AP34Q",
      "MktNm": "EQUITY-CASH",
      "SctyCtgyNm": "BDR",
      "ISIN": "BRA1APBDR001",
      "CrpnNm": "ADVANCE AUTO PARTS INC"
    },
    {
      "RptDt": "2024-08-23",
      "TckrSymb": "A1AP34R",
      "MktNm": "EQUITY-CASH",
      "SctyCtgyNm": "BDR",
      "ISIN": "BRA1APBDR001",
      "CrpnNm": "ADVANCE AUTO PARTS INC"
    },
    {
      "RptDt": "2024-08-23",
      "TckrSymb": "A1CR34",
      "MktNm": "EQUITY-CASH",
      "SctyCtgyNm": "BDR",
      "ISIN": "BRA1CRBDR003",
      "CrpnNm": "AMCOR PLC"
    },
    {
      "RptDt": "2024-08-23",
      "TckrSymb": "A1CR34M",
      "MktNm": "EQUITY-CASH",
      "SctyCtgyNm": "BDR",
      "ISIN": "BRA1CRBDR003",
      "CrpnNm": "AMCOR PLC"
    },
    {
      "RptDt": "2024-08-23",
      "TckrSymb": "A1CR34Q",
      "MktNm": "EQUITY-CASH",
      "SctyCtgyNm": "BDR",
      "ISIN": "BRA1CRBDR003",
      "CrpnNm": "AMCOR PLC"
    }
  ],
  "links": {
    "first": "http://localhost:8000/api/v1/search?page=1",
    "last": "http://localhost:8000/api/v1/search?page=400",
    "prev": null,
    "next": "http://localhost:8000/api/v1/search?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 400,
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "page": null,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=1",
        "label": "1",
        "page": 1,
        "active": true
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=2",
        "label": "2",
        "page": 2,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=3",
        "label": "3",
        "page": 3,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=4",
        "label": "4",
        "page": 4,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=5",
        "label": "5",
        "page": 5,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=6",
        "label": "6",
        "page": 6,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=7",
        "label": "7",
        "page": 7,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=8",
        "label": "8",
        "page": 8,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=9",
        "label": "9",
        "page": 9,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=10",
        "label": "10",
        "page": 10,
        "active": false
      },
      {
        "url": null,
        "label": "...",
        "active": false
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=399",
        "label": "399",
        "page": 399,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=400",
        "label": "400",
        "page": 400,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/v1/search?page=2",
        "label": "Next &raquo;",
        "page": 2,
        "active": false
      }
    ],
    "path": "http://localhost:8000/api/v1/search",
    "per_page": 10,
    "to": 10,
    "total": 4000
  },
  "message": "Success"
}
```

## 🚀 Como rodar localmente

1. Clonar o projeto
```bash
git clone https://github.com/cintiaribeiro/desafio-desenvolvedor
cd upload-hub
```

2. Instalar dependências PHP
```bash
 composer install

```
3. COnfigura o .env

```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel

MONGO_DB_URI=mongodb://mongodb:27017/processed_files

REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PORT=6379
```
4. Rodar migrations
 
```bash
php artisan migrate

```

5. Rodar seedres
```bash
php artisan db:seed

```

## 📚 Referências de Documentação
- https://laravel.com/docs

## 👨‍💻 Autor
Desenvolvido por @cintiaribeiro