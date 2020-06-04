/*

ANDRE ABREU - andrea.abreu@gmail.com
Desafio Desenvolvedor Oliveira-Trust
https://www.linkedin.com/in/abreulandre/

Cronograma

03/06/2020
ISSUE #001 - CLONAR REPOSITORIO - 30
ISSUE #002 - CRIAR PROJETO LARAVEL E AJUSTES DE BANCO - 30
ISSUE #003 - CRIAR API-CRUD CLIENTES - 30
ISSUE #004 - CRIAR CRUD CLIENTES - 30
ISSUE #005 - CRIAR CRUD PRODUTOS - 30
ISSUE #006 - CRIAR CRUD PEDIDOS  - 30
ISSUE #007 - CRIAR API-CRUD CLIENTES - 30
ISSUE #008 - CRIAR API-CRUD PRODUTOS - 30
ISSUE #009 - CRIAR API-CRUD PEDIDOS  - 30
ISSUE #010 - TESTE API-CRUD CLIENTES - 30
ISSUE #011 - TESTE API-CRUD PRODUTOS - 30
ISSUE #012 - TESTE API-CRUD PEDIDOS  - 30

04/06/2020
ISSUE #013 - ANALIZE VIEW BOOTSTRAP E TESTE CRUD CLIENTES - 1
ISSUE #014 - ANALIZE VIEW BOOTSTRAP E TESTE CRUD PRODUTOS - 1
ISSUE #015 - ANALIZE VIEW BOOTSTRAP E TESTE CRUD PEDIDOS - 1
ISSUE #016 - FILTROS E ORDEM VIEW CLIENTES - 1
ISSUE #017 - FILTROS E ORDEM VIEW PRODUTOS - 1
ISSUE #018 - FILTROS E ORDEM VIEW PEDIDOS - 1

05/06/2020
ISSUE #019 - APLICAR CORRELACAO BANCO TABELA PEDIDOS - 2
ISSUE #020 - TESTAR VIEW CORRELACAO PEDIDOS - 1
ISSUE #020 - APLICAR AUTENTICAÇÃO - 1
ISSUE #021 - APLICAR NAVEGAÇÃO - 1
ISSUE #022 - TESTES FINAIS - 30
ISSUE #022 - ENTREGA - 30

*/

λ git clone add desafio-desenvolvedor https://github.com/andreabreu76/desafio-desenvolvedor.git
λ cd desafio-desenvolvedor
λ git checkout -b andreabreu

λ composer create-project laravel/laravel oliveiratrust

λ mysql -uroot
	mysql> CREATE DATABASE oliveiratrust CHARACTER SET utf8 COLLATE utf8_general_ci;
	mysql> exit
cd 
λ vim .env
	DB_DATABASE=oliveiratrust

λ composer require appzcoder/crud-generator
λ vim config/app.php	
	config/app.php
		PROVIDERS
		----------------------------
		Appzcoder\CrudGenerator\CrudGeneratorServiceProvider::class,
	    Collective\Html\HtmlServiceProvider::class,

		ALIASES
		----------------------------
		'Form'      => Collective\Html\FormFacade::class,
		'HTML'      => Collective\Html\HtmlFacade::class,

CRUD
------------------------

λ php artisan crud:generate clientes --fields="nome_cli#text; email_cli#text; tel_cli#text; aniv_cli#date"  --controller-namespace=Clientes --route-group=admin --form-helper=html

λ php artisan crud:generate produtos --fields="nome_prod#text; fab_prod#date; forn_nome#text; forn_contato#text"  --controller-namespace=Produtos --route-group=admin --form-helper=html

λ php artisan crud:generate pedidos  --fields="data_ped#date; cli_id#integer; prod_id#integer" --controller-namespace=Pedidos --route-group=admin --form-helper=html


CONTROLLER
-------------------------

λ php artisan crud:controller ClientesController --crud-name=clientes --model-name=Clientes --route-group=admin

λ php artisan crud:controller ProdutosController --crud-name=produtos --model-name=Produtos --route-group=admin

λ php artisan crud:controller PedidosController --crud-name=pedidos --model-name=Pedidos --route-group=admin


VIEWS
-------------------------

λ php artisan crud:view Clientes --fields=="nome_cli#text; email_cli#text; tel_cli#text; aniv_cli#date" --route-group=admin --form-helper=html

λ php artisan crud:view Produtos --fields=="nome_prod#text; fab_prod#date; forn_nome#text; forn_contato#text" --route-group=admin --form-helper=html

λ php artisan crud:view Pedidos --fields=="data_ped#date; cli_id#integer; prod_id#integer" --route-group=admin --form-helper=html

λ php artisan migrate


API CRUD
-------------------------

λ php artisan crud:api Clientes --fields="nome_cli#text; email_cli#text; tel_cli#text; aniv_cli#date" --controller-namespace=Api

λ php artisan crud:api Produtos --fields="nome_prod#text; fab_prod#date; forn_nome#text; forn_contato#text" --controller-namespace=Api

λ php artisan crud:api Pedidos  --fields="data_ped#date; cli_id#integer; prod_id#integer" --controller-namespace=Api


API CONTROLLER
-------------------------

λ php artisan crud:api-controller Api\\ClientesController --crud-name=clientes --model-name=Clientes

λ php artisan crud:api-controller Api\\ProdutosController --crud-name=produtos --model-name=Produtos

λ php artisan crud:api-controller Api\\PedidosController --crud-name=pedidos --model-name=Pedidos
