/*

ANDRE ABREU - andrea.abreu@gmail.com
Desafio Desenvolvedor Oliveira-Trust
https://www.linkedin.com/in/abreulandre/

Cronograma

03/06/2020
OK - ISSUE #001 - CLONAR REPOSITORIO - 30
OK - ISSUE #002 - CRIAR PROJETO LARAVEL E AJUSTES DE BANCO - 30
OK - ISSUE #003 - CRIAR API-CRUD CLIENTES - 30
OK - ISSUE #004 - CRIAR CRUD CLIENTES - 30
OK - ISSUE #005 - CRIAR CRUD PRODUTOS - 30
OK - ISSUE #006 - CRIAR CRUD PEDIDOS  - 30
OK - ISSUE #008 - CRIAR API-CRUD PRODUTOS - 30
OK - ISSUE #007 - CRIAR API-CRUD CLIENTES - 30
OK - ISSUE #009 - CRIAR API-CRUD PEDIDOS  - 30
OK - ISSUE #010 - TESTE API-CRUD CLIENTES - 30
OK - ISSUE #011 - TESTE API-CRUD PRODUTOS - 30
OK - ISSUE #012 - TESTE API-CRUD PEDIDOS  - 30

04/06/2020
OK - ISSUE #013 - ANALIZE VIEW BOOTSTRAP E TESTE CRUD CLIENTES - 1
OK - ISSUE #014 - ANALIZE VIEW BOOTSTRAP E TESTE CRUD PRODUTOS - 1
OK - ISSUE #015 - ANALIZE VIEW BOOTSTRAP E TESTE CRUD PEDIDOS - 1
ISSUE #016 - FILTROS E ORDEM VIEW CLIENTES - 1
ISSUE #017 - FILTROS E ORDEM VIEW PRODUTOS - 1
ISSUE #018 - FILTROS E ORDEM VIEW PEDIDOS - 1

05/06/2020
ISSUE #019 - APLICAR CORRELACAO BANCO TABELA PEDIDOS - 2
ISSUE #020 - TESTAR VIEW CORRELACAO PEDIDOS - 1
OK - ISSUE #020 - APLICAR AUTENTICAÇÃO - 1
OK - ISSUE #021 - APLICAR NAVEGAÇÃO - 1
ISSUE #022 - TESTES FINAIS - 30
ISSUE #022 - ENTREGA - 30

*/

git clone add desafio-desenvolvedor https://github.com/andreabreu76/desafio-desenvolvedor.git
cd desafio-desenvolvedor
git checkout -b andreabreu

composer create-project laravel/laravel oliveiratrust

mysql -uroot
	mysql> CREATE DATABASE oltrust_db CHARACTER SET utf8 COLLATE utf8_general_ci;
	mysql> CREATE USER 'desafdev'@'localhost' IDENTIFIED BY 'devpass!123';
	mysql> GRANT ALL ON *.oltrust_db TO 'desafdev'@'localhost';
	mysql> FLUSH PRIVILEGES;
	mysql> exit
cd 
vim .env
	DB_DATABASE=oltrust_db
	DB_USERNAME=desafdev
	DB_PASSWORD=devpass!123

composer require appzcoder/crud-generator
vim config/app.php	
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

php artisan crud:generate clientes --fields="cliente_nome#text; cliente_email#text; cliente_tel#text; cliente_aniv#date"  --controller-namespace=Clientes --route-group=admin --form-helper=html --soft-deletes=yes

php artisan crud:generate produtos --fields="produto_nome#text; produto_val#date; produto_forn#text; produto_cont#text; produto_preco#double"  --controller-namespace=Produtos --route-group=admin --form-helper=html --soft-deletes=yes

php artisan crud:generate pedidos  --fields="pedido_ident#integer; pedido_data#date; cliente_id#integer; produto_id#integer" --controller-namespace=Pedidos --route-group=admin --form-helper=html --soft-deletes=yes


CONTROLLER
-------------------------

php artisan crud:controller ClientesController --crud-name=clientes --model-name=Clientes --route-group=admin

php artisan crud:controller ProdutosController --crud-name=produtos --model-name=Produtos --route-group=admin

php artisan crud:controller PedidosController --crud-name=pedidos --model-name=Pedidos --route-group=admin


VIEWS
-------------------------

php artisan crud:view Clientes --fields="cliente_nome#text; cliente_email#text; cliente_tel#text; cliente_aniv#date" --route-group=admin --form-helper=html

php artisan crud:view Produtos --fields="produto_nome#text; produto_val#date; produto_forn#text; produto_cont#text; produto_preco#double" --route-group=admin --form-helper=html

php artisan crud:view Pedidos --fields="pedido_ident#integer; pedido_data#date; cliente_id#integer; produto_id#integer" --route-group=admin --form-helper=html

php artisan migrate


API CRUD
-------------------------

php artisan crud:api Clientes --fields="cliente_nome#text; cliente_email#text; cliente_tel#text; cliente_aniv#date" --controller-namespace=Api

php artisan crud:api Produtos --fields="produto_nome#text; produto_val#date; produto_forn#text; produto_cont#text; produto_preco#double" --controller-namespace=Api

php artisan crud:api Pedidos  --fields="pedido_ident#integer; pedido_data#date; cliente_id#integer; produto_id#integer" --controller-namespace=Api


API CONTROLLER
-------------------------

php artisan crud:api-controller Api\\ClientesController --crud-name=clientes --model-name=Clientes

php artisan crud:api-controller Api\\ProdutosController --crud-name=produtos --model-name=Produtos

php artisan crud:api-controller Api\\PedidosController --crud-name=pedidos --model-name=Pedidos


User Interface 
------------------------

composer require laravel/ui
php artisan ui vue --auth

*Install NPM 

npm install
npm run dev
npm install font-awesome --save


Sort/Order View 
------------------------

composer require kyslik/column-sortable

vim config/app.php
	config/app.php
		PROVIDERS
		----------------------------
		Kyslik\ColumnSortable\ColumnSortableServiceProvider::class,

php artisan vendor:publish --provider="Kyslik\ColumnSortable\ColumnSortableServiceProvider" --tag="config"




