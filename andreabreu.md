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

### 06/06/2020 ###
- [X] ISSUE #019 - APLICAR CORRELACAO BANCO TABELA PEDIDOS - 6h

### 08/06/2020 ###
- [X] ISSUE #023 - APLICAR FORMATACAO DESSE MARKDOWN - 2h
- [X] ISSUE #023 - ATUALIZAÇÃO REPOSITORIO - 2h

### 09/06/2020 ###
- [ ] ISSUE #020 - TESTAR VIEW CORRELACAO PEDIDOS - 1h
- [ ] ISSUE #016 - FILTROS E ORDEM VIEW CLIENTES - 1h
- [ ] ISSUE #017 - FILTROS E ORDEM VIEW PRODUTOS - 1h
- [ ] ISSUE #018 - FILTROS E ORDEM VIEW PEDIDOS - 1h
- [ ] ISSUE #022 - TESTES FINAIS - 0.5h
- [ ] ISSUE #022 - ENTREGA - 0.5h


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
composer create-project laravel/laravel oltrust
```

```bash
mysql -uroot
```
```mysql
CREATE DATABASE oltrust_db CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER 'desafdev'@'localhost' IDENTIFIED BY 'devpass!123';
GRANT ALL ON oltrust_db.* TO 'desafdev'@'localhost';
FLUSH PRIVILEGES;
```
```bash
vim .env
```
	CONTEUDO
	-----------------------
	DB_DATABASE=oltrust_db2
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

```bash
vim config/app.php
```
	PROVIDERS
	----------------------------
	Appzcoder\CrudGenerator\CrudGeneratorServiceProvider::class,
	Collective\Html\HtmlServiceProvider::class,

	ALIASES
	---------------------------
	'Form'      => Collective\Html\FormFacade::class,
	'HTML'      => Collective\Html\HtmlFacade::class,

CRUD
------------------------
```bash
php artisan crud:generate clientes --fields="cliente_nome#string; cliente_email#string; cliente_tel#string; cliente_aniv#date"  --controller-namespace=Clientes --route-group=admin --form-helper=html --soft-deletes=yes
```
```bash
php artisan crud:generate produtos --fields="produto_nome#string; produto_val#date; produto_forn#string; produto_cont#string; produto_preco#double"  --controller-namespace=Produtos --route-group=admin --form-helper=html --soft-deletes=yes
```
```bash
php artisan crud:generate condicoes --fields="condicoes#string;"  --controller-namespace=condicoes --route-group=admin --form-helper=html --soft-deletes=yes
```
CONTROLLER
-------------------------
```bash
php artisan crud:controller ClientesController --crud-name=clientes --model-name=Clientes --route-group=admin
```
```bash
php artisan crud:controller ProdutosController --crud-name=produtos --model-name=Produtos --route-group=admin
```
```bash
php artisan crud:controller CondicoesController --crud-name=condicoes --model-name=Statuses --route-group=admin
```

VIEWS
-------------------------
```bash
php artisan crud:view Clientes --fields="cliente_nome#text; cliente_email#text; cliente_tel#text; cliente_aniv#date" --route-group=admin --form-helper=html
```
```bash
php artisan crud:view Produtos --fields="produto_nome#text; produto_val#date; produto_forn#text; produto_cont#text; produto_preco#double" --route-group=admin --form-helper=html
```
```bash
php artisan crud:view Condicoes --fields="condicoes#string" --route-group=admin --form-helper=html
```

```bash
php artisan migrate
```

API CRUD
-------------------------

```bash
php artisan crud:api Clientes --fields="cliente_nome#text; cliente_email#text; cliente_tel#text; cliente_aniv#date" --controller-namespace=Api
```
```bash
php artisan crud:api Produtos --fields="produto_nome#text; produto_val#date; produto_forn#text; produto_cont#text; produto_preco#double" --controller-namespace=Api
```
```bash
php artisan crud:api Condicoes --fields="condicoes#string;" --controller-namespace=Api
```

API CONTROLLER
-------------------------
```bash
php artisan crud:api-controller Api\\ClientesController --crud-name=clientes --model-name=Clientes
```
```bash
php artisan crud:api-controller Api\\ProdutosController --crud-name=produtos --model-name=Produtos
```
```bash
php artisan crud:api-controller Api\\CondicoesController --crud-name=status --model-name=Condicoes
```

IMPORTANTE - DEVIDO A REFERENCIA ESTE DEVE SER UM SEGUNDO MIGRATE
-------------------------

```bash
php artisan crud:generate pedidos  --fields="pedido_ident#integer; pedido_data#date; cliente_id#integer#unsigned; produto_id#integer#unsigned; condicoes_id#integer#unsigned" --foreign-keys="cliente_id#id#clientes; produto_id#id#produtos; condicoes_id#id#condicoes" --controller-namespace=Pedidos --route-group=admin --form-helper=html --soft-deletes=yes
```

É NECESSARIO EDITAR O ARQUIVO DE MIGRACAO PARA QUE A RELACAO ENTRE TABELAS SEJAM FEITA CORRETAMENTE.
-------------------------
```bash
vim database/migration/*_create_pedidos_table.php
```
```php
public function up()
{
	Schema::create('pedidos', function (Blueprint $table) {
		$table->increments('id');
		$table->timestamps();
		$table->softDeletes();
		$table->integer('pedido_ident')->nullable();
		$table->date('pedido_data')->nullable();

		/*
		*   RELAÇÃO DE PEDIDO
		*/
		$table->integer('cliente_id')->unsigned();
		$table->integer('produto_id')->unsigned();
		$table->integer('condicoes_id')->unsigned();

		/*
		*   REFERENCIA DAS RELAÇÕES
		*/
		$table->foreign('cliente_id')->references('id')->on('clientes');
		$table->foreign('produto_id')->references('id')->on('produtos');
		$table->foreign('condicoes_id')->references('id')->on('condicoes');
		});
}
```
```bash
php artisan crud:controller PedidosController --crud-name=pedidos --model-name=Pedidos --route-group=admin
```
```bash
php artisan crud:view Pedidos --fields="pedido_ident#integer; pedido_data#date; cliente_id#integer; produto_id#integer; condicoes_id#integer" --route-group=admin --form-helper=html
```
```bash
php artisan migrate
```
```bash
php artisan crud:api Pedidos  --fields="pedido_ident#integer; pedido_data#date; cliente_id#integer; produto_id#integer" --controller-namespace=Api
```
```bash
php artisan crud:api-controller Api\\PedidosController --crud-name=pedidos --model-name=Pedidos
```

PARA REFERENCIA
------------------------

```mysql
Select pedidos.id, pedidos.pedido_ident,
  pedidos.pedido_data,
  clientes.cliente_nome,
  produtos.produto_nome,
  produtos.produto_preco,
  condicoes.condicoes
From pedidos
  Inner Join clientes On clientes.id = pedidos.cliente_id
  Inner Join produtos On produtos.id = pedidos.produto_id
  Inner Join condicoes On condicoes.id = pedidos.condicoes_id
Order By pedidos.id
```

User Interface
------------------------
```bash
composer require laravel/ui
```
```bash
php artisan ui vue --auth
```
Install NPM
------------------------

```bash
npm install
```
```bash
npm run dev
```
```bash
npm install font-awesome --save
```
```bash
vim routes/web.php
```
		Auth::routes();
		Route::get('admin/dashboard', 'HomeController@index')->name('dashboard')->middleware('auth');

		~~ADICIONAR ->middleware('auth') AO FIM DAS LINHAS RESOURCES.~~
