# 📚 Oliveira-Trust - Desafio Desenvolvedor.

## 📙Descrição deste Projeto:

Criar uma API com no mínimo 3 endpoints, com as seguintes funcionalidades:

- Upload de arquivo ✅
- Histórico de upload de arquivo ✅
- Buscar conteúdo do arquivo ✅
- Banco de dados NOSQL para armazenar os dados do upload ✅
- Autenticação para consumir Endpoints ✅
- Execução dentro de Container Docker ✅

## 🛠️ Os requisitos do projeto:

Para executar este projeto, você precisará ter instalado:

- Docker Desktop (executar os containers)
- Python ^3.12
- Poetry ^1.8.3 (Gerenciador de pacotes do Python)

#### Dependências de projeto:
- Fastapi ^0.115.3
- Uvicorn ^0.32.0
- motor ^3.6.0
- Pandas ^2.2.3
- python-jose ^3.3.0
- python-multipart ^0.0.12
- openpyxl ^3.1.5
- xlrd ^2.0.1
- passlib ^1.7.4

#### Dependências de desenvolvimento:
- Ruff 0.5.5 (Linter)
- Taskipy 1.13.0 (Executor de tarefas)

## 🖥️ Instalação:

1. Clone o repositório:

```bash
git https://github.com/fspjonny/desafio-desenvolvedor.git
```
```bash
Vá para o diretório da aplicação:
cd proj_api
```

2. Crie um ambiente virtual com o Poetry:

```
poetry shell
```

3. Instale as dependências do projeto:

```
poetry install
```

## 🚀 Uso:
Após instalar as dependências, de dentro da pasta do projeto, execute o comando do Docker:

```
docker-compose up --build
```
A aplicação vai ser executada dentro de um container Docker contendo este projeto e mais um banco de dados MongoDB 4.2.

```
Observação:
- O Docker Compose vai criar automaticamente os containers de banco de dados MongoDB da aplicação e iniciar o servidor FastAPI com uvicorn.

- Se você quiser parar o servidor, pressione `Ctrl + C`.

- Se você quiser reiniciar o servidor, execute o comando `docker-compose up --build` novamente.

Abra o seu navegador, a aplicação estará disponível para ser executada no endereço local: `http://localhost:8000`.
```
## ⚙️ Endpoint de Uploads:

### Upload de arquivo:

Endpoint: `/upload`

Método: `POST`

#### Parâmetros:

- `file`: Arquivo a ser enviado.

#### Resposta:

- `status`: Status do upload.
- `message`: Mensagem de feedback.
- `file_id`: ID do arquivo.

### Histórico de upload de arquivo:

Endpoint: `/history`

Método: `GET`

#### Resposta:

- `history`: Lista com os IDs dos arquivos enviados.

### Buscar conteúdo do arquivo:

Endpoint: `/file/{file_id}`

Método: `GET`

#### Parâmetros:

- `file_id`: ID do arquivo a ser buscado.

#### Resposta:

- `file`: Arquivo buscado.


## ⚙️ Endpoint de Autenticação:

### Register:

Endpoint: `/register`

Método: `POST`

#### Parâmetros:

- `{
  "username": "username",
  "password": "password"
} `

#### Resposta:

- `status`: Status.
- `token`: Token de autorização.


### Token:

Endpoint: `/token`

Método: `POST`

#### Parâmetros:

- `{
  "username": "username",
  "password": "password"
} `

#### Resposta:

- `status`: Status.
- `token`: Token de autorização.