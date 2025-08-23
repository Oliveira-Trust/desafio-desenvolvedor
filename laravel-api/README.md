# Desafio Desenvolvedor Oliveira Trust

## Visão geral

Este projeto é um sistema Laravel desenvolvido para o processamento eficiente de arquivos CSV e Excel contendo dados de instrumentos financeiros. O sistema utiliza filas assíncronas e processamento em lote para garantir alta performance e escalabilidade.

## Funcionalidades Principais

### 1. Upload de Arquivos
- **Endpoint**: `POST /api/upload`
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

### 2. Histórico de upload de arquivo
- **Endpoint**: `GET /api/history`
- **Parâmetros de busca**: 
filename → InstrumentsConsolidatedFile_20240823.csv
date → 2025-08-23
- **Obrigatoridade dos parâmetros**: É necessário ao menos 1 dos parâmetros para que possa ser realizada a consulta

### 3. Buscar conteúdo do arquivo
- **Endpoint**: `GET /api/conteudo`
- **Parâmetros de busca:**: 
TckrSymb → AMZO34
RptDt → 2024-08-22
- **Obrigatoridade dos parâmetros**: É opcional enviar parâmetros
- **Paginação**: Em caso de falta de parâmetro, paginação será implementada para evitar timeout
- **Lógica de Cache**: Para evitar consultas em excesso para a mesma requisição
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

### POST /api/upload

**Descrição**: Upload e processamento de arquivo de instrumentos financeiros

**Headers**:
```
Content-Type: multipart/form-data
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

**Arquivo Duplicado (409)**:
```json
{
    "error": "Arquivo já enviado"
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

### Validações Implementadas
- Verificação de MIME types
- Validação de extensões de arquivo
- Proteção contra uploads maliciosos
- Hash SHA256 para integridade