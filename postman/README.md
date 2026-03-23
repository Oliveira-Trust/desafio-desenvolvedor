# Colecao Postman - Desafio Desenvolvedor API

Este diretorio concentra os artefatos do Postman atualizados com o fluxo stateful real da aplicacao.

## Arquivos

- `collection.json`: colecao com as rotas e cenarios principais da API
- `environment.local.json`: ambiente local com variaveis para login, filtros, upload e correlacao

## Funcionalidades cobertas

- bootstrap de CSRF com `GET /sanctum/csrf-cookie`
- login stateful com `POST /api/auth/login`
- logout com `POST /api/auth/logout`
- upload autenticado com `POST /api/uploads`
- historico de uploads com e sem filtros
- consultas de market data com e sem filtros

## Como usar

1. Importe `collection.json` e `environment.local.json` no Postman.
2. Selecione o ambiente `Local`.
3. Ajuste `base_url` se necessario.
4. Preencha `upload_file_path` com um arquivo local valido.
5. Execute `Obter CSRF Cookie`.
6. Execute `Login`.
7. Rode as requisicoes autenticadas.
8. Execute `Logout` ao final.

## Observacoes

- a autenticacao e feita por cookie de sessao, nao por Bearer token
- o cookie jar do Postman precisa estar habilitado
- requisicoes `POST` enviam `X-XSRF-TOKEN` automaticamente
- `POST /api/uploads` envia `X-Request-Id`
- as respostas de sucesso seguem `{ data, meta, message? }`
- as respostas de erro seguem `{ error, trace_id }`
