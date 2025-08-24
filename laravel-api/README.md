# Desafio Desenvolvedor Oliveira Trust

## Visão geral

Este projeto é um sistema Laravel desenvolvido para o processamento eficiente de arquivos CSV e Excel contendo dados de instrumentos financeiros. O sistema utiliza filas assíncronas, processamento em lote e **autenticação por token** para garantir alta performance, escalabilidade e segurança.

## ⚠️ **AUTENTICAÇÃO OBRIGATÓRIA**

**IMPORTANTE**: Todas as 3 funcionalidades principais do sistema (**Upload de Arquivos**, **Histórico de Upload** e **Busca de Conteúdo**) requerem autenticação via token Bearer. É necessário realizar login ou registro antes de consumir esses endpoints.

### Como Autenticar:
1. **Registre um novo usuário** ou **faça login** com credenciais existentes
2. **Obtenha o token** retornado na resposta
3. **Inclua o token** no header `Authorization: Bearer {token}` em todas as requisições

## Funcionalidades Principais

### 🔐 **Autenticação e Registro**
- **Registro**: `POST /api/register` - Criar nova conta de usuário
- **Login**: `POST /api/login` - Autenticar e obter token de acesso
- **Logout**: `POST /api/logout` - Invalidar token atual (requer auth)
- **Dados do Usuário**: `GET /api/user` - Obter informações do usuário logado (requer auth)

### 1. Upload de Arquivos 🔒
- **Endpoint**: `POST /api/upload` **(REQUER AUTENTICAÇÃO)**
- **Formatos Suportados**: CSV (.csv), Excel (.xlsx, .xls)
- **Validação Avançada**: Verifica MIME types e extensões para evitar uploads maliciosos
- **Detecção de Duplicatas**: Previne reprocessamento usando hash SHA256 do arquivo
- **Sistema de Filas**: Utiliza Laravel Queues para processamento em background
- **Processamento em Chunks**: Processa arquivos em lotes de 500 linhas por job
- **Escalabilidade**: Suporte a múltiplos workers para processamento paralelo
- **Tratamento de Encoding**: Normalização automática para UTF-8
- **Banco de Dados**: MongoDB para flexibilidade e performance
- **Modelo**: `ProductsList` com 47 campos específicos para instrumentos financeiros
- **Insert em Lote**: Otimização de performance com inserções bulk
- **Rastreabilidade**: Cada registro vinculado ao hash do arquivo de origem
- **Limpeza de Cache**: Após uma nova entrada, o cache geral é limpo para garantir que as informações mais recentes sejam retornadas.

### 2. Histórico de upload de arquivo 🔒
- **Endpoint**: `GET /api/history` **(REQUER AUTENTICAÇÃO)**
- **Parâmetros de busca**: 
filename → InstrumentsConsolidatedFile_20240823.csv
date → 2025-08-23 (yyyy-mm-dd)
- **Obrigatoridade dos parâmetros**: É necessário ao menos 1 dos parâmetros para que possa ser realizada a consulta
- **Lógica de Cache**: Para evitar consultas em excesso para a mesma requisição, foi estabelecido cache de 10min

### 3. Buscar conteúdo do arquivo 🔒
- **Endpoint**: `GET /api/file-contents` **(REQUER AUTENTICAÇÃO)**
- **Parâmetros de busca:**: 
TckrSymb → AMZO34
RptDt → 2024-08-22
- **Obrigatoridade dos parâmetros**: É opcional enviar parâmetros
- **Paginação**: Em caso de falta de parâmetro, paginação será implementada para evitar timeout
- **Lógica de Cache**: Para evitar consultas em excesso para a mesma requisição foi estabelecido cache de 10min
- **O retorno esperado deve conter no mínimo essas informações**:
```
{
  "RptDt": "2024-08-22",
  "TckrSymb": "AMZO34",
  "MktNm": "EQUITY-CASH",
  "SctyCtgyNm": "BDR",
  "ISIN": "BRAMZOBDR002",
  "CrpnNm": "AMAZON.COM, INC"
}
```

## Arquitetura do Sistema

### Fluxo de Processamento

```
Upload → Validação → Hash Check → Armazenamento → Queue Job → Chunk Processing → MongoDB
```

1. **Controller** (`FileUploadController`): Recebe e valida o arquivo
2. **Job Principal** (`ProcessUploadedFile`): Lê o arquivo e divide em chunks
3. **Job Secundário** (`ProcessFileRow`): Processa chunks de 500 linhas
4. **Model** (`ProductsList`): Persiste os dados no MongoDB

### Componentes Principais

#### FileUploadController
```
// Validações implementadas:
- Arquivo obrigatório
- MIME types específicos: text/plain, text/csv, application/vnd.ms-excel, etc.
- Verificação de extensão para arquivos text/plain (apenas CSV)
- Detecção de duplicatas por hash SHA256
- Salva no MySQL o nome do arquivo e seu hash
```

#### ProcessUploadedFile (Job Principal)
```
// Características:
- Lê arquivos usando Spatie SimpleExcel, utiliza Lazy Collection
- Suporte a delimitador personalizado (;)
- Skip automático da linha de "Status de arquivo"
- Header pré-definido com 47 campos esperados
- Processamento em chunks de 500 linhas 
```

##### Por que 500 linhas?
Durante a implementação, estabeleci o job secundário para executar 1 linha por job, tendo um resultado de 2ms por job, entretanto, era muito custoso para CPU e demoraria em média 150s para 75.000 linhas...

Afim de aumentar o dinamismo e eficiência do projeto, estabeleci: 500 por job. Sendo 28ms por job. Sendo basicamente 150 jobs a serem executados em uma margem de 4.2s

Fui aumentando e percebi também que o ganho diminuia por chunk aumentado
1000 por job = 4s
5000 por job = 3.9s

Logo, estabeleci 500 por job o default do projeto.

#### ProcessFileRow (Job Secundário)
```
// Funcionalidades:
- Processa lotes de até 500 linhas
- Combina header com dados das linhas
- Remove campos vazios
- Insert em lote no MongoDB
- Otimização de memória
```

## Configuração e Instalação

### Pré-requisitos
- PHP 8.2+
- Composer 2
- MySQL
- MongoDB
- Laravel 11
- Redis

### Instalação

1. **Clone o repositório**
```bash
git clone <repository-url>
cd laravel-api
```

2. **Instale as dependências**
```bash
composer install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
# Configure as variáveis do MongoDB e Queue
```

4. **Execute as migrações**
```bash
php artisan migrate
```

5. **Configure a fila**
```bash
# Para desenvolvimento
php artisan queue:work

# Para produção com Supervisor
php artisan queue:work --queue=default --sleep=3 --tries=3 --max-time=3600
```

## Configurações de Ambiente

### MongoDB
```env
DB_CONNECTION=mongodb
MONGODB_HOST=127.0.0.1
MONGODB_PORT=27017
MONGODB_DATABASE=uploads_db
```

### Queue
```env
QUEUE_CONNECTION=redis
```

## API Reference

### 🔐 **AUTENTICAÇÃO**

#### POST /api/register

**Descrição**: Registra um novo usuário no sistema

**Headers**:
```
Content-Type: application/json
```

**Body**:
```json
{
    "name": "João Silva",
    "email": "joao@exemplo.com",
    "password": "123456",
    "password_confirmation": "123456"
}
```

**Responses**:

**Sucesso (201)**:
```json
{
    "success": true,
    "message": "Usuário registrado com sucesso",
    "data": {
        "user": {
            "id": 1,
            "name": "João Silva",
            "email": "joao@exemplo.com",
            "email_verified_at": null,
            "created_at": "2025-08-24T14:30:00.000000Z",
            "updated_at": "2025-08-24T14:30:00.000000Z"
        },
        "token": "1|abcdef123456789...",
        "token_type": "Bearer"
    }
}
```

**Erro de Validação (422)**:
```json
{
    "success": false,
    "message": "Dados de validação inválidos",
    "errors": {
        "email": ["Este email já está sendo utilizado."],
        "password": ["A confirmação da senha não confere."]
    }
}
```

#### POST /api/login

**Descrição**: Autentica um usuário e retorna token de acesso

**Headers**:
```
Content-Type: application/json
```

**Body**:
```json
{
    "email": "joao@exemplo.com",
    "password": "123456"
}
```

**Responses**:

**Sucesso (200)**:
```json
{
    "success": true,
    "message": "Login realizado com sucesso",
    "data": {
        "user": {
            "id": 1,
            "name": "João Silva",
            "email": "joao@exemplo.com",
            "email_verified_at": null,
            "created_at": "2025-08-24T14:30:00.000000Z",
            "updated_at": "2025-08-24T14:30:00.000000Z"
        },
        "token": "2|xyz789123456...",
        "token_type": "Bearer"
    }
}
```

**Credenciais Inválidas (401)**:
```json
{
    "success": false,
    "message": "Credenciais inválidas"
}
```

**Erro de Validação (422)**:
```json
{
    "success": false,
    "message": "Dados de validação inválidos",
    "errors": {
        "email": ["O campo email é obrigatório."],
        "password": ["O campo senha deve ter pelo menos 6 caracteres."]
    }
}
```

#### POST /api/logout 🔒

**Descrição**: Faz logout e invalida o token atual

**Headers**:
```
Content-Type: application/json
Authorization: Bearer {token}
```

**Responses**:

**Sucesso (200)**:
```json
{
    "success": true,
    "message": "Logout realizado com sucesso"
}
```

**Não autorizado (401)**:
```json
{
    "message": "Unauthenticated."
}
```

#### GET /api/user 🔒

**Descrição**: Retorna os dados do usuário autenticado

**Headers**:
```
Content-Type: application/json
Authorization: Bearer {token}
```

**Responses**:

**Sucesso (200)**:
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "João Silva",
        "email": "joao@exemplo.com",
        "email_verified_at": null,
        "created_at": "2025-08-24T14:30:00.000000Z",
        "updated_at": "2025-08-24T14:30:00.000000Z"
    }
}
```

**Não autorizado (401)**:
```json
{
    "message": "Unauthenticated."
}
```

---

### 📁 **ENDPOINTS PRINCIPAIS** (Todos requerem autenticação)

#### POST /api/upload 🔒

**Descrição**: Upload e processamento de arquivo de instrumentos financeiros

**Headers**:
```
Content-Type: multipart/form-data
Authorization: Bearer {token}
```

**Body**:
```
file: [arquivo CSV ou Excel]
```

**Responses**:

**Sucesso (200)**:
```json
{
    "message": "Upload realizado e enviado para processamento"
}
```

**Erro de Validação (422)**:
```json
{
    "error": {
        "file": ["The file field must be a file."]
    }
}
```

**Não autorizado (401)**:
```json
{
    "message": "Unauthenticated."
}
```

**Arquivo Duplicado (409)**:
```json
{
    "error": "Arquivo já enviado"
}
```

### GET /api/history 🔒

**Descrição**: Busca por uploads de arquivos realizados

**Headers**:
```
Content-Type: application/json
Authorization: Bearer {token}
```

**Params**:
```
filename: [nome exato do arquivo com extensão]
date: [data no formato yyyy-mm-dd]
```

**Responses**:

**Sucesso (200)**:
```json
{
    "message": "Histórico de uploads",
    "filters": {
        "filename": "InstrumentsConsolidatedFile_20250820_1.csv",
        "date": "2025-08-24"
    },
    "data": [
        {
            "id": 5,
            "file_name": "InstrumentsConsolidatedFile_20250820_1.csv",
            "file_hash": "d18cf977c76bee456a8b49bca2a3920c0a41c52c0c4079d93c41c4c79365c742",
            "created_at": "2025-08-24T13:58:53.000000Z",
            "updated_at": "2025-08-24T13:58:53.000000Z"
        }
    ]
}
```

**Arquivo Duplicado (404)**:
```json
{
    "message": "Nenhum histórico de uploads encontrado"
}
```

**Erro de Validação (422)**:
```json
{
    "error": "É necessário informar pelo menos um dos parâmetros: filename ou date"
}
```

**Não autorizado (401)**:
```json
{
    "message": "Unauthenticated."
}
```

### GET /api/file-contents 🔒

**Descrição**: Busca o conteúdo de arquivos, direto do MongoDB, utilizando paginação em caso de falta de parâmetros.

**Headers**:
```
Content-Type: application/json
Authorization: Bearer {token}
```

**Params**:
```
TckrSymb: [símbolo do ticker, ex: 003H11]
RptDt: [data do relatório, ex: 2025-08-20]
```

**Responses**:

**Sucesso (200)**: (Busca específica)
```json
{
    "message": "Listagem de conteúdos específicos",
    "data": [
        {
            "RptDt": "2025-08-20",
            "TckrSymb": "003H11",
            "Asst": "003H",
            "AsstDesc": "003H",
            "SgmtNm": "CASH",
            "MktNm": "EQUITY-CASH",
            "SctyCtgyNm": "FUNDS",
            "XprtnDt": "",
            "XprtnCd": "",
            "TradgStartDt": "9999-12-31",
            "TradgEndDt": "9999-12-31",
            "BaseCd": "",
            "ConvsCritNm": "",
            "MtrtyDtTrgtPt": "",
            "ReqrdConvsInd": "",
            "ISIN": "BR003HCTF006",
            "CFICd": "CICGRY",
            ...
            "DstrbtnId": "100",
            "PricFctr": "1",
            "DaysToSttlm": "2",
            "SrsTpNm": "",
            "PrtcnFlg": "",
            "AutomtcExrcInd": "",
            "SpcfctnCd": "CI",
            "CrpnNm": "KINEA CO-INVESTIMENTO FDO INV IMOB",
            "CorpActnStartDt": "9999-12-31",
            "CtdyTrtmntTpNm": "FUNGIBLE",
            "MktCptlstn": "15000",
            "CorpGovnLvlNm": "",
            "file_hash": "d18cf977c76bee456a8b49bca2a3920c0a41c52c0c4079d93c41c4c79365c742",
            "id": "68ab1aa4837380df2b01bf02"
        }
    ]
}
```

**Sucesso (200)**: (Listagem sem parâmetros)
```json
{
    "message": "Listagem de conteúdos paginada",
    "current_page": 1,
    "data": [
        {
            "RptDt": "2025-08-20",
            "TckrSymb": "003H11",
            "Asst": "003H",
            "AsstDesc": "003H",
            "SgmtNm": "CASH",
            "MktNm": "EQUITY-CASH",
            "SctyCtgyNm": "FUNDS",
            "XprtnDt": "",
            "XprtnCd": "",
            "TradgStartDt": "9999-12-31",
            "TradgEndDt": "9999-12-31",
            "BaseCd": "",
            "ConvsCritNm": "",
            "MtrtyDtTrgtPt": "",
            "ReqrdConvsInd": "",
            "ISIN": "BR003HCTF006",
            "CFICd": "CICGRY",
            ...
            "DstrbtnId": "100",
            "PricFctr": "1",
            "DaysToSttlm": "2",
            "SrsTpNm": "",
            "PrtcnFlg": "",
            "AutomtcExrcInd": "",
            "SpcfctnCd": "CI",
            "CrpnNm": "KINEA CO-INVESTIMENTO FDO INV IMOB",
            "CorpActnStartDt": "9999-12-31",
            "CtdyTrtmntTpNm": "FUNGIBLE",
            "MktCptlstn": "15000",
            "CorpGovnLvlNm": "",
            "file_hash": "d18cf977c76bee456a8b49bca2a3920c0a41c52c0c4079d93c41c4c79365c742",
            "id": "68ab1aa4837380df2b01bf02"
        },
        {
            "RptDt": "2025-08-20",
            "TckrSymb": "0FEA11",
            "Asst": "0FEA",
            "AsstDesc": "0FEA",
            "SgmtNm": "CASH",
            "MktNm": "EQUITY-CASH",
            "SctyCtgyNm": "FUNDS",
            "XprtnDt": "",
            "XprtnCd": "",
            "TradgStartDt": "9999-12-31",
            "TradgEndDt": "9999-12-31",
            "BaseCd": "",
            "ConvsCritNm": "",
            "MtrtyDtTrgtPt": "",
            "ReqrdConvsInd": "",
            "ISIN": "BR0FEACTF006",
            "CFICd": "CICGRY",
            ...
            "DstrbtnId": "100",
            "PricFctr": "1",
            "DaysToSttlm": "2",
            "SrsTpNm": "",
            "PrtcnFlg": "",
            "AutomtcExrcInd": "",
            "SpcfctnCd": "CI",
            "CrpnNm": "SPIM FUNDO DE INVESTIMENTO IMOBILI?RIO",
            "CorpActnStartDt": "9999-12-31",
            "CtdyTrtmntTpNm": "FUNGIBLE",
            "MktCptlstn": "1631616",
            "CorpGovnLvlNm": "",
            "file_hash": "d18cf977c76bee456a8b49bca2a3920c0a41c52c0c4079d93c41c4c79365c742",
            "id": "68ab1aa4837380df2b01bf03"
        },
        ...
    ],
    "next_page_url": "http://127.0.0.1:8000/api/file-contents?page=2",
    "path": "http://127.0.0.1:8000/api/file-contents",
    "per_page": 20,
    "prev_page_url": null,
    "to": 20,
    "total": 100874
}
```

**Arquivo Duplicado (404)**:
```json
{
    "message": "Nenhum conteúdo encontrado"
}
```

**Erro de Validação (422)**:
```json
{
    "error": "É necessário informar os 2 parâmetros: TckrSymb e RptDt; Para busca precisa"
}
```

**Não autorizado (401)**:
```json
{
    "message": "Unauthenticated."
}
```

## Estrutura de Dados

### Campos do Arquivo de Entrada
O sistema processa arquivos com os seguintes 47 campos:

| RptDt | TckrSymb | Asst | AsstDesc | SgmtNm | MktNm | SctyCtgyNm | XprtnDt | XprtnCd | TradgStartDt | TradgEndDt | BaseCd | ConvsCritNm | MtrtyDtTrgtPt | ReqrdConvsInd | ISIN | CFICd | DlvryNtceStartDt | DlvryNtceEndDt | OptnTp | CtrctMltplr | AsstQtnQty | AllcnRndLot | TradgCcy | DlvryTpNm | WdrwlDays | WrkgDays | ClnrDays | RlvrBasePricNm | OpngFutrPosDay | SdTpCd1 | UndrlygTckrSymb1 | SdTpCd2 | UndrlygTckrSymb2 | PureGoldWght | ExrcPric | OptnStyle | ValTpNm | PrmUpfrntInd | OpngPosLmtDt | DstrbtnId | PricFctr | DaysToSttlm | SrsTpNm | PrtcnFlg | AutomtcExrcInd | SpcfctnCd | CrpnNm | CorpActnStartDt | CtdyTrtmntTpNm | MktCptlstn | CorpGovnLvlNm |
|-------|----------|------|----------|--------|-------|------------|---------|---------|--------------|------------|--------|------------|---------------|---------------|------|-------|-----------------|----------------|--------|-------------|------------|-------------|----------|-----------|-----------|----------|----------|----------------|----------------|---------|-----------------|---------|-----------------|--------------|----------|-----------|--------|--------------|--------------|-----------|----------|-------------|--------|----------|----------------|-----------|--------|----------------|----------------|------------|----------------|


### Formato do Arquivo
- **Delimitador**: Ponto e vírgula (`;`)
- **Primeira linha**: Status do arquivo (ignorada)
- **Segunda linha**: Dados (processados)
- **Encoding**: UTF-8 (normalizado automaticamente)

## Performance e Otimizações

### Estratégias Implementadas

1. **Processamento em Chunks**: 500 linhas por job reduz uso de memória
2. **Insert em Lote**: Múltiplas inserções em uma única query
3. **Normalização UTF-8**: Previne erros de encoding
4. **Liberação de Memória**: `unset()` explícito após processamento
5. **Queue Assíncrono**: Não bloqueia requisições HTTP

### Comandos Úteis

```bash
# Executa o Laravel
php artisan serve

# Limpar fila
php artisan queue:flush

# Reprocessar jobs falhados
php artisan queue:retry all

# Monitorar jobs
php artisan queue:work --verbose

# Cache clear
php artisan cache:clear
php artisan config:clear
```

## Segurança

### Sistema de Autenticação
- **Laravel Sanctum**: Tokens de API seguros
- **Autenticação Obrigatória**: Todas as funcionalidades principais protegidas
- **Tokens Personalizados**: Cada usuário pode ter múltiplos tokens ativos
- **Logout Seguro**: Invalidação individual de tokens

### Validações Implementadas
- Verificação de MIME types
- Validação de extensões de arquivo
- Proteção contra uploads maliciosos
- Hash SHA256 para integridade
- Autenticação via Bearer Token