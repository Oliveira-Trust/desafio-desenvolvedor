
# Controle de Clientes e Pedidos de Compra

Projeto desenvolvido em Laravel e Mysql implementando um CRUD simples para Clientes, Produtos, além do fluxo de Pedidos de Compra com STATUS e aprovação do pedido via usuário Administrador.


## Deploy
A Aplicação está com deploy automático no endereço:
> desafiodev.herokuapp.com

para acessar faca seu cadastro e crie um cliente.
depois entre na tela de pedidos e faça um pedido.

há um usuário criado com permissões administrativas:
> administrador@administrador.com

> senha: os numeros de 1 a 8. (escreva os numeros por favor).

nele, você tem acesso a todos os pedidos de todos os usuários, e o cadastro de produtos


## O que foi feito/falta ser feito

**Básico:**
-  - [x] ~~CRUD de Clientes~~
-  - [x] ~~CRUD de Produtos~~
-  - [x] ~~CRUD de Pedidos de Compra~~
-  - [x] ~~Filtrar e Ordenar listagens por qualquer campo~~
-  - [x] ~~Barra de Navegação entre CRUDs~~
-  - [x] ~~Links para os outros CRUDs nas listagens (Ex: link para o detalhe do cliente da compra na lista de pedidos de compra)~~

**Bônus:**
-  - [x] ~~Implementar autenticação de usuário na aplicação.~~
-  - [ ] Permitir deleção em massa de itens nos CRUDs.
-  - [x] ~~Implementar a camada de Front-End utilizando a biblioteca javascript Bootstrap e ser responsiva.~~
-  - [ ] API Rest JSON para todos os CRUDS listados acima.

**Bônus 2:**
-  - [x] Usuário Master / Padrão (flag no banco).
-  - [x] View diferencia funcões para o master que não autoriza para o padrão (exemplo, aceitar o pagamento ou cancelar o pedido).
-  - [x] Sistema se adapta para exibir de forma diferente as grids caso esteja acessando via celular.
-  - [x] Status extras para mais controle.
-  - [x] STATUS : 
-  -  - 'Pedido em digitação'
-  -  - 'Aguardando pagamento'
-  -  - 'Pagamento confirmado'
-  -  - 'Cancelado'
-  - [ ] API GraphQL.



## Instalação

Clone o Repositório(`desafio-desenvlvedor`)  

Entre no diretório `desafio-desenvolvedor`.

> cd desafio-desenvolvedor


Execute o arquivo run.sh
> ./run.sh

acesse o Localhost
>http://localhost