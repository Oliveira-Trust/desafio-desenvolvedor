# API de Instrumentos Financeiros

Este projeto consiste em uma API RESTful robusta para ingestão, processamento e consulta de grandes volumes de dados financeiros (arquivos da B3 com +300.000 linhas).

O foco principal do desenvolvimento foi **performance, escalabilidade e integridade de dados**, garantindo que o sistema processe arquivos pesados sem comprometer a memória do servidor ou a experiência do usuário.

## Tecnologias Utilizadas

* **Linguagem:** PHP 8
* **Framework:** Laravel 12
* **Banco de Dados:** MySQL 8.4
* **Ambiente:** Docker (via Laravel Sail)
* **Leitura de Arquivos:** OpenSpout v4 (Leitura via Streaming para baixo consumo de RAM)
* **Assincronismo:** Laravel Jobs & Queues (Database Driver)
* **Cache:** Redis/File Cache
* **Autenticação:** Laravel Sanctum

---

## Decisões de Arquitetura

Para atender aos requisitos de processar arquivos com grandes volumes de linhas e garantir buscas rápidas, foram tomadas as seguintes decisões:

1.  **Processamento em Background (Jobs):**
    * O upload do arquivo apenas salva o CSV/Excel em disco e libera o usuário imediatamente.
    * O processamento pesado ocorre em uma **Fila (Queue)**, evitando *timeouts* no navegador e gargalos no servidor HTTP.

2.  **Leitura em Streaming (OpenSpout):**
    * Em vez de carregar o arquivo inteiro na memória (o que travaria o servidor com arquivos grandes), utilizei o **OpenSpout** para ler linha a linha e preparar para inserir em batch. Isso mantém o uso de RAM baixo e constante, independente se o arquivo tem 100 linhas ou 1 milhão.

3.  **Otimização de Banco de Dados:**
    * Criação de **Índices (Indexes)** nas colunas `tckr_symb` e `rpt_dt`.
    * Uso de `Insert Batch` (lotes de 1.000 registros) para reduzir a carga do banco de dados, resultando em uma importação média de 1.500 registros/segundo.

4.  **Cache Inteligente:**
    * O endpoint de busca utiliza cache. Consultas repetidas retornam instantaneamente, aliviando o banco de dados de fazer consultas repetidas.

5.  **Padronização de Saída (API Resources):**
    * Utilização de *API Resources* para transformar os dados do banco (`snake_case`) no padrão exigido pelo desafio (`PascalCase`), desacoplando a lógica do banco da interface da API.

---

## Instalação e Configuração

O projeto foi containerizado usando **Docker**. Certifique-se de tê-lo instalado.
Será necessário usar `sail` no terminal, é possível criar um alias caso deseje.

1.  **Clone o repositório:**
    ```bash
    git clone https://github.com/TheAkuma010/desafio-desenvolvedor.git
    cd desafio-desenvolvedor
    git checkout Gabriel_Torres_da_Costa
    cd desafio-desenvolvedor
    ```

2.  **Configure as variáveis de ambiente:**
    ```bash
    cp .env.example .env
    ```
    *Certifique-se de que `QUEUE_CONNECTION=database` está definido no .env.*

3.  **Instale as dependências:**
    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php84-composer:latest \
        composer install --ignore-platform-reqs
    ```

4.  **Suba os containers:**
    ```bash
    ./vendor/bin/sail up -d
    ```

5.  **Configuração final (key e banco de dados):**
    ```bash
    ./vendor/bin/sail artisan key:generate
    ./vendor/bin/sail artisan migrate --seed
    ```
    *O comando `--seed` criará um usuário padrão para testes.*

6.  **Inicie o processador de filas:**
    ```bash
    ./vendor/bin/sail artisan queue:work
    ```
---

## Como Rodar a Aplicação

Para que o sistema funcione corretamente, você precisa de **dois terminais** rodando:

1.  **Terminal 1 (Aplicação):** Onde o Docker estará rodando.
2.  **Terminal 2 (Processador de Filas):** Deve ser usado para que os arquivos enviados sejam processados.

---

## Autenticação e Testes

A API é protegida via Token (Sanctum). Adicione o header `Accept: application/json` em todas as requisições para obter o retorno em JSON.

### 1. Obter Token de Acesso
Utilize o usuário criado pelo seeder:

* **Rota:** `POST /api/login`
* **Body:**
    ```json
    {
        "email": "admin@admin.com.br",
        "password": "admin12345"
    }
    ```
* **Resposta:** Copie o `token` retornado.

Use este token no Header das próximas requisições:
`Authorization: Bearer 1|seu_token_aqui...`

### 2. Upload de Arquivo
* **Rota:** `POST /api/upload`
* **Body:** `multipart/form-data` com campo `file`.
* **Formatos aceitos:** .csv, .txt, .xlsx, .xls.
* *Nota: O arquivo será colocado na fila e processado pelo worker ao usar o queue:work.*

### 3. Histórico de Envios
* **Rota:** `GET /api/history`
* **Filtros (Parâmetros):** `file_name`, `date`.
* **Exemplo:** `/api/history?date=2026-01-07&file_name=Instruments`

### 4. Busca de Instrumentos
* **Rota:** `GET /api/instruments`
* **Filtros (Parâmetros):** `TckrSymb`, `RptDt`.
* **Exemplo:** `/api/instruments?TckrSymb=AMZO34&RptDt=2024-08-26`

---

## Testes de Qualidade

Durante o desenvolvimento, foram validados os seguintes cenários:
* [x] Upload de arquivos Excel (.xlsx) e CSV.
* [x] Bloqueio de arquivos duplicados (via Hash MD5).
* [x] Validação de cabeçalho (Rejeita arquivos que não tenham a coluna "RptDt").
* [x] Validação de formatos inválidos (PDF, Imagens).
* [x] Performance com arquivo de 300.000+ linhas (Tempo médio: ~3 min em ambiente Docker local).

---

Desenvolvido por **Gabriel Torres da Costa**
[https://linkedin.com/in/gabriel-t-costa]
