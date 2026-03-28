# B3 Instruments API

API REST desenvolvida com **Laravel 13** e **MongoDB** para upload, armazenamento e consulta de dados de instrumentos listados na B3.

---

## Tecnologias

- PHP 8.3 + Laravel 13
- MongoDB 7 (via `mongodb/laravel-mongodb`)
- Nginx
- Docker + Docker Compose

---

## Estrutura do Projeto

```
.
├── docker-compose.yml
├── nginx/
│   └── default.conf
└── laravel/
    ├── Dockerfile
    ├── php.ini
    ├── app/
    │   ├── Http/Controllers/
    │   │   ├── UploadController.php
    │   │   └── InstrumentController.php
    │   ├── Models/
    │   │   ├── Upload.php
    │   │   └── Instrument.php
    │   └── Services/
    │       └── FileImportService.php
    |       └── InstrumentService.php
    |       └── UploadService.php
    └── routes/
        └── api.php
```

---

## Como Rodar

### Requisitos

- Docker
- Docker Compose

### Passo a passo

```bash
# 1. Clone o repositório
git clone <repo-url>
cd <repo-folder>

# 2. Copie e configure o arquivo de ambiente
cp laravel/.env.example laravel/.env

# 3. Suba os containers
docker compose up -d --build

# 4. Instale as dependências PHP
docker compose exec app composer install

# 5. Instale o pacote MongoDB para Laravel
docker compose exec app composer require mongodb/laravel-mongodb

# 6. Gere a chave da aplicação
docker compose exec app php artisan key:generate

# 7. Habilite as rotas de API
docker compose exec app php artisan install:api
```

A API estará disponível em `http://localhost:8080`.

---

## Endpoints

### POST /api/upload

Faz o upload de um arquivo CSV ou Excel e importa os dados de instrumentos no MongoDB.

- Formatos aceitos: `.csv`, `.xlsx`, `.xls`
- O mesmo arquivo não pode ser enviado duas vezes (verificado via hash MD5)
- Arquivos da B3 possuem uma linha de metadados antes do cabeçalho — tratado automaticamente

**Requisição** (`multipart/form-data`):

| Campo | Tipo    | Obrigatório |
|-------|---------|-------------|
| file  | Arquivo | Sim         |

**Resposta** `201`:
```json
{
  "message": "File imported successfully.",
  "upload_id": "65f1a2b3c4d5e6f7a8b9c0d1",
  "original_name": "InstrumentsConsolidatedFile_20240822.csv",
  "rows_imported": 74832,
  "status": "done"
}
```

---

### GET /api/uploads

Retorna o histórico de uploads com filtros opcionais.

**Parâmetros de query** (todos opcionais):

| Parâmetro | Tipo   | Descrição                          |
|-----------|--------|------------------------------------|
| filename  | string | Filtra pelo nome original do arquivo |
| date      | string | Filtra pela data de referência (Y-m-d) |

**Exemplo:**
```
GET /api/uploads?filename=Instruments&date=2024-08-22
```

**Resposta** `200` (paginada):
```json
{
  "data": [
    {
      "_id": "65f1a2b3c4d5e6f7a8b9c0d1",
      "original_name": "InstrumentsConsolidatedFile_20240822.csv",
      "size": 15728640,
      "rows_imported": 74832,
      "status": "done",
      "reference_date": "2024-08-22T00:00:00.000Z",
      "created_at": "2024-08-22T10:00:00.000Z"
    }
  ],
  "current_page": 1,
  "per_page": 15,
  "total": 1
}
```

---

### GET /api/instruments

Consulta os instrumentos importados com filtros opcionais. Sem parâmetros, retorna o resultado paginado.

**Parâmetros de query** (todos opcionais):

| Parâmetro | Tipo   | Descrição                        |
|-----------|--------|----------------------------------|
| TckrSymb  | string | Filtra pelo código do ticker     |
| RptDt     | string | Filtra pela data do relatório (Y-m-d) |

**Exemplos:**
```
GET /api/instruments
GET /api/instruments?TckrSymb=AMZO34
GET /api/instruments?TckrSymb=AMZO34&RptDt=2024-08-26
```

**Resposta** `200` (paginada):
```json
{
  "data": [
    {
      "RptDt": "2024-08-22",
      "TckrSymb": "AMZO34",
      "MktNm": "EQUITY-CASH",
      "SctyCtgyNm": "BDR",
      "ISIN": "BRAMZOBDR002",
      "CrpnNm": "AMAZON.COM, INC"
    }
  ],
  "current_page": 1,
  "per_page": 20,
  "total": 5
}
```

---

## Regras de Negócio

- O mesmo arquivo não pode ser enviado duas vezes (verificado via hash MD5)
- Formatos aceitos: CSV e Excel (`.xlsx`, `.xls`)
- Arquivos CSV da B3 possuem uma linha de metadados antes do cabeçalho — ignorada automaticamente
- Arquivos da B3 usam encoding ISO-8859-1 — convertido automaticamente para UTF-8 na importação
- Registros são inseridos em lotes de 500 para suportar arquivos grandes com eficiência
- O histórico de uploads pode ser filtrado por nome do arquivo ou data de referência

---

## Fonte dos Dados

Os arquivos diários podem ser baixados no site da B3:

> [https://www.b3.com.br/pt_br/market-data-e-indices/servicos-de-dados/market-data/consultas/boletim-diario/dados-publicos-de-produtos-listados-e-de-balcao/](https://www.b3.com.br/pt_br/market-data-e-indices/servicos-de-dados/market-data/consultas/boletim-diario/dados-publicos-de-produtos-listados-e-de-balcao/)

Clique em uma data → "Cadastro de Instrumentos (Listado)" → "Baixar arquivo".
