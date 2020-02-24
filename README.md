## Sobre o projeto

CRUD's para gestão de clientes, produtos e pedidos.
Teste para vaga de trabalho.

- Crud de clientes. (Usando o model User)
- Crud de produtos.
- Crud de pedidos e itens.

Alguns cruds estão com um if no controller para retornar tanto os dados por um resource JSON, como para views do blade.
Em um projeto real não seguiria essa abordagem. Faria um controller para API e outro para uma web app normal.

## Banco de dados

Uso de MySQL com as tabelas sendo criadas pelo sistema de migrations do Laravel.

## Pacotes de terceiros utilizados

Para facilitar algumas coisas usei alguns pacotes que já me foram utéis em outros projetos.

- [Para validação de CPF](https://github.com/geekcom/validator-docs)
