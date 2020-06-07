# Desafio Desenvolvedor Oliveira-Trust #
* ANDRE ABREU - andrea.abreu@gmail.com *
* https://www.linkedin.com/in/abreulandre/ *

## Cronograma ##

### 03/06/2020 ###
- [X] ISSUE #001 - CLONAR REPOSITORIO - 0.5h
- [X] ISSUE #002 - CRIAR PROJETO LARAVEL E AJUSTES DE BANCO - 0.5h
- [X] ISSUE #003 - CRIAR API-CRUD CLIENTES - 0.5h
- [X] ISSUE #004 - CRIAR CRUD CLIENTES - 0.5h
- [X] ISSUE #005 - CRIAR CRUD PRODUTOS - 0.5h
- [X] ISSUE #006 - CRIAR CRUD PEDIDOS  - 0.5h
- [X] ISSUE #008 - CRIAR API-CRUD PRODUTOS - 0.5h
- [X] ISSUE #007 - CRIAR API-CRUD CLIENTES - 0.5h
- [X] ISSUE #009 - CRIAR API-CRUD PEDIDOS  - 0.5h
- [X] ISSUE #010 - TESTE API-CRUD CLIENTES - 0.5h
- [X] ISSUE #011 - TESTE API-CRUD PRODUTOS - 0.5h
- [X] ISSUE #012 - TESTE API-CRUD PEDIDOS  - 0.5h

### 04/06/2020 ###
- [X] ISSUE #013 - ANALIZE VIEW BOOTSTRAP E TESTE CRUD CLIENTES - 1h
- [X] ISSUE #014 - ANALIZE VIEW BOOTSTRAP E TESTE CRUD PRODUTOS - 1h
- [X] ISSUE #015 - ANALIZE VIEW BOOTSTRAP E TESTE CRUD PEDIDOS - 1h
- [X] ISSUE #020 - APLICAR AUTENTICAÇÃO - 2h
- [X] ISSUE #021 - APLICAR NAVEGAÇÃO - 1h

### 05/06/2020 ###
- [X] ISSUE #019 - APLICAR CORRELACAO BANCO TABELA PEDIDOS - 6h

###06/06/2020###
- [X] ISSUE #019 - APLICAR CORRELACAO BANCO TABELA PEDIDOS - 6h

### 08/06/2020 ###
### 09/06/2020 ###
- ISSUE #020 - TESTAR VIEW CORRELACAO PEDIDOS - 1h
- ISSUE #016 - FILTROS E ORDEM VIEW CLIENTES - 1h
- ISSUE #017 - FILTROS E ORDEM VIEW PRODUTOS - 1h
- ISSUE #018 - FILTROS E ORDEM VIEW PEDIDOS - 1h
- ISSUE #022 - TESTES FINAIS - 0.5h
- ISSUE #022 - ENTREGA - 0.5h


Github
------------------------

```bash
git clone add desafio-desenvolvedor https://github.com/andreabreu76/desafio-desenvolvedor.git
cd desafio-desenvolvedor
git checkout -b andreabreu
```

Projeto
------------------------
Criando projeto.

```bash
composer create-project laravel/laravel oliveiratrust
```

```bash
mysql -uroot
```
```sql
mysql> CREATE DATABASE oltrust_db CHARACTER SET utf8 COLLATE utf8_general_ci;
mysql> CREATE USER 'desafdev'@'localhost' IDENTIFIED BY 'devpass!123';
mysql> GRANT ALL ON *.oltrust_db TO 'desafdev'@'localhost';
mysql> FLUSH PRIVILEGES;
mysql> exit
```
```bash
vim .env
```
	CONTEUDO
	-----------------------
	DB_DATABASE=oltrust_db
	DB_USERNAME=desafdev
	DB_PASSWORD=devpass!123


Locale pt-br
------------------------
```bash
composer require lucascudo/laravel-pt-br-localization
```
```bash
php artisan vendor:publish --tag=laravel-pt-br-localization
```
```bash
vim config/app.php (linha 83)
```
	'locale' => 'pt_BR',

CRUD Generator
------------------------
composer require appzcoder/crud-generator

vim config/app.php

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

php artisan crud:generate clientes --fields="cliente_nome#string; cliente_email#string; cliente_tel#string; cliente_aniv#date"  --controller-namespace=Clientes --route-group=admin --form-helper=html --soft-deletes=yes

php artisan crud:generate produtos --fields="produto_nome#string; produto_val#date; produto_forn#string; produto_cont#string; produto_preco#double"  --controller-namespace=Produtos --route-group=admin --form-helper=html --soft-deletes=yes

php artisan crud:generate status --fields="status#string;"  --controller-namespace=Status --route-group=admin --form-helper=html --soft-deletes=yes

CONTROLLER
-------------------------

php artisan crud:controller ClientesController --crud-name=clientes --model-name=Clientes --route-group=admin

php artisan crud:controller ProdutosController --crud-name=produtos --model-name=Produtos --route-group=admin

VIEWS
-------------------------

php artisan crud:view Clientes --fields="cliente_nome#text; cliente_email#text; cliente_tel#text; cliente_aniv#date" --route-group=admin --form-helper=html

php artisan crud:view Produtos --fields="produto_nome#text; produto_val#date; produto_forn#text; produto_cont#text; produto_preco#double" --route-group=admin --form-helper=html

php artisan migrate


API CRUD
-------------------------

php artisan crud:api Clientes --fields="cliente_nome#text; cliente_email#text; cliente_tel#text; cliente_aniv#date" --controller-namespace=Api

php artisan crud:api Produtos --fields="produto_nome#text; produto_val#date; produto_forn#text; produto_cont#text; produto_preco#double" --controller-namespace=Api

API CONTROLLER
-------------------------

php artisan crud:api-controller Api\\ClientesController --crud-name=clientes --model-name=Clientes

php artisan crud:api-controller Api\\ProdutosController --crud-name=produtos --model-name=Produtos


IMPORTANTE - deVIDO A REFERENCIA ESTE DEVE SER UM SEGUNDO MIGRATE
-------------------------
-------------------------

php artisan crud:generate pedidos  --fields="pedido_ident#integer; pedido_data#date; cliente_id#integer#unsigned; produto_id#integer#unsigned; pedido_status#select#options={"aberto": "Aberto", "aguardando": "Aguardando", "finalizado": "Finalizado"}" --foreign-keys="cliente_id#id#clientes" --foreign-keys="produto_id#id#produtos" --controller-namespace=Pedidos --route-group=admin --form-helper=html --soft-deletes=yes

vim database/migration/*_create_pedidos_table.php
	CORRIGIR AS REFERENCIAS MANUALMENTE, TALVEZ POR UM BUG, SOMENTE É REGISTRADO UMA REFERENCIA (produtos) E A OUTRA (clientes) É IGNORADA. DEVE-SE FAZER ESSA CORREÇÃO.

php artisan crud:controller PedidosController --crud-name=pedidos --model-name=Pedidos --route-group=admin

php artisan crud:view Pedidos --fields="pedido_ident#integer; pedido_data#date; cliente_id#integer; produto_id#integer; pedido_status#select#options={"aberto": "Aberto", "aguardando": "Aguardando", "finalizado": "Finalizado"}" --route-group=admin --form-helper=html

php artisan migrate

php artisan crud:api Pedidos  --fields="pedido_ident#integer; pedido_data#date; cliente_id#integer; produto_id#integer" --controller-namespace=Api

php artisan crud:api-controller Api\\PedidosController --crud-name=pedidos --model-name=Pedidos


PARA REFERENCIA
------------------------
Select pedidos.id, pedidos.pedido_ident,
  pedidos.pedido_data,
  clientes.cliente_nome,
  produtos.produto_nome,
  produtos.produto_preco,
  pedidos.pedido_status
From pedidos
  Inner Join clientes On clientes.id = pedidos.cliente_id
  Inner Join produtos On produtos.id = pedidos.produto_id
Order By pedidos.id

User Interface
------------------------

composer require laravel/ui
php artisan ui vue --auth

*Install NPM

npm install
npm run dev
npm install font-awesome --save


vim routes/web.php
		Auth::routes();
		Route::get('admin/dashboard', 'HomeController@index')->name('dashboard')->middleware('auth');

		[!] ADICIONAR ->middleware('auth') AO FIM DAS LINHAS RESOURCES.




Sort/Order View
------------------------

composer require kyslik/column-sortable

vim config/app.php
	config/app.php
		PROVIDERS
		----------------------------
		Kyslik\ColumnSortable\ColumnSortableServiceProvider::class,

php artisan vendor:publish --provider="Kyslik\ColumnSortable\ColumnSortableServiceProvider" --tag="config"
