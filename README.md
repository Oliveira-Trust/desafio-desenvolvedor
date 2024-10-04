# Instruções para configuração e uso do consumer de planilhas - Oliveira Trust

## Documentação da API

#### Retorna lista de instrumentos ou um instrumento específico

```
  GET /instruments/?TckrSymb={var}&RptDt={var}
```

| Parâmetro   | Tipo       |
| :---------- | :--------- |
| `TckrSymb` | `string` |
| `RptDt` | `string` |

#### Envia arquivo

```
  POST /upload
```

| Parâmetro   | Tipo       |
| :---------- | :--------- |
| `file`      | `file` |

```
curl -X POST http://localhost:8000/upload/ -F "file=@InstrumentsConsolidatedFile_20240823.csv"
```
## Setup ambiente (Ubuntu ou WSL)
`$ sudo apt install make -y`
#### Backend
`cd backend`

`$ sudo apt update -y`

`$ sudo apt install software-properties-common -y`

`$ sudo apt install -y build-essential git curl python3 python3-pip python`

`$ make init`

Usuário de testes: N: OliveiraTrust P: 123

URL: localhost:8000

### Comandos Makefile
#### Backend
Apresenta os logs do container selecionado, web, db, rq, redis...

`$ make logs {ARGS}`
___
Inicia todos os serviços:

`$ make up`
___
Para todos os serviços:

`$ make stopall`
___
Cria o super user:


`$ make createsu`
___
Roda o comando flake8 para verificar a PEP8 do código:

`$ make flake8`
___

Para executar qualquer comando do Django (Django management commmands):

`$ make dj "<comando> e opções entre aspas"`
___

Para instalar um novo pacote python:

`$ make install "<pacote> [pacote]"`

* Isso instala o pacote no container e atualiza os arquivos Pipfile
* Caso o pacote instalado seja usado apenas para o desenvolvimento, user a flag `--dev`

___

Para iniciar, parar ou reiniciar um serviço/container, respectivamente, use:

`$ make start [nome do servico]`

`$ make stop [nome do servico]`

`$ make restart [nome do servico]`

Os serviços disponíveis são:

- db: postgres
- rq: worker do rq
- web: a aplicação django
- redis: redis sendo usado como fila consumida pelo Celery
___

Para executar os tests:

`$ make test`

___
Para reiniciar o worker do rq:

`$ make restart_rq`
___
Mais comandos make:
- `up_debug`: inicia o container django em modo debug
- `recreate_db`: dropa o banco de dados, cria um novo e realiza as migrações do django
- `restore_database`: restaura um dump de banco de dados e aplica as migrações
- `restore_dblocal`: restaura um dump e cria o super usuário
- `migrate`: aplica as migrações do django no container
- `makemigrations`: cria as migrações do django
- `makemigrations_merge`: realiza o merge das migrations do django
- `docker_prune`: para e remove todos os containers/imagens
- `_rebuild`: rebuilda todos os containers sem cache
