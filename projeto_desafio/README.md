## Sobre

Projeto desenvolvido para processar arquivos de Intrumentos Consolidados da B3 (https://www.b3.com.br/pt_br/market-data-e-indices/servicos-de-dados/market-data/consultas/boletim-diario/dados-publicos-de-produtos-listados-e-de-balcao/)


## Funcionalidades

* **Upload de arquivos em formato CSV ou XLSX**
* **Pesquisa do histórico de uploads**
* **Busca de registros do conteúdo dos arquivos**

## Endpoints

## _Upload_
**Request** 

```
POST /api/upload
Accept: application/json
Authorization: Bearer token
```

**Request Body**
* form-data
  * files[] (file): Arquivos para upload.

**Validation**
* files[]
  * Arquivos no formato CSV e XLSX
  * Não é permitido enviar o mesmo arquivo 2x

**Response**

* _**Status 200**_
    ```json
    {
        "message": "Arquivo adicionado na fila de processamento."
    }
    ```

## _Histórico de upload_
**Request**

```
POST /api/history
Accept: application/json
Content-Type: application/json
Authorization: Bearer token
```

**Request Body**
```json
{
    "filename": "nome_do_arquivo.csv",
    "created_at": "2024-09-15"
}
```

**Validation**
* filename
    * String
    * Obrigatório quando não informado o campo 'created_at'
* created_at
    * date (Y-m-d)
    * Obrigatório quando não informado o campo 'filename'

**Response**

* _**Status 200**_
```json
[
    {
        "filename": "InstrumentsConsolidatedFile_20240822_20240827.csv",
        "created_at": "2024-09-17T05:36:00.959000Z"
    }
]
```
* _**Status 204**_


## _Busca registros_
**Request - Sem Filtro**

```
POST /api/search
Accept: application/json
Content-Type: application/json
Authorization: Bearer token
```

**Request - Com Filtro**

```
POST /api/search?page=1
Accept: application/json
Content-Type: application/json
Authorization: Bearer token
```

**Request Body**
```json
{
    "RptDt": "2024-08-23",
    "TckrSymb": "003H11"
}
```

**Request Param**
* page
  * Opcional (Utilizado somente quando os parâmetros de filtro não são informados)

**Validation**
* RptDt
    * String
    * Obrigatório quando informado o campo 'TckrSymb'
* TckrSymb
    * String
    * Obrigatório quando informado o campo 'RptDt'

**Response**

* _**Status 200 - Com filtro**_
```json
[
    {
        "filename": "InstrumentsConsolidatedFile_20240822_20240827.csv",
        "created_at": "2024-09-17T05:36:00.959000Z"
    }
]
```

* _**Status 200 - Sem filtro**_
```json
{
    "totalItens": 10,
    "perPage": 2,
    "current": 1,
    "nextPage": 2,
    "previusPage": null,
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
            "TckrSymb": "A1AP34",
            "MktNm": "EQUITY-CASH",
            "SctyCtgyNm": "BDR",
            "ISIN": "BRA1APBDR001",
            "CrpnNm": "ADVANCE AUTO PARTS INC"
        }
    ]
}
```
* _**Status 204**_

## _Gerar token_
**Request**

```
POST /api/token
Accept: application/json
Content-Type: application/json
```

**Request Body**
```json
{
    "email": "test@example.com",
    "password": "123456"
}
```

**Validation**
* email
    * String
    * Obrigatório
* password
    * string
    * Obrigatório

**Response**

* _**Status 200**_
```json
{
    "token": "5|rjpG5YpK8sXeDwikb05sa5XXOt4azb8ZaCijXfsIa7092cb0"
}
```

### Iniciando o projeto

1. Faça o clone deste repositório
2. Instale as dependências\
`composer install`
3. Crie o arquivo .env através do modelo .env.example\
`cp .env.example .env`
4. Faça as configurações necessárias no arquivo .env
5. Gere as tabelas executando o migration\
`php artisan migrate`
6. Carga inicial com dados de testes (somente em ambiente de teste)\
`php artisan db:seed` 
7. Inicie o servidor\
`php artisan serve`
8. Para processar a fila de upload utilize o comando\
`php artisan queue:work`

**Obs: Utilize o Mongodb e mysql neste projeto**
