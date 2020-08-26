
## Desafio Oliveira Trust 


## Implementação concluída
+ CRUD de clientes.
+ CRUD de produtos.
+ CRUD de pedidos.
+ **Bônus**: Deleção em massa de itens nos CRUDs.
+ **Bônus**: Uso de Bootstrap e responsividade das telas.


## Tecnologias utilizadas
+ PHP 7.1.3
+ MySQL 5.7.17
+ Laravel Framework 5.8.38
+ Bootstrap 4.5.2
+ Cleave.js 1.5.8
+ DataTables 1.10.21 e plugins:
    + responsive 2.2.5
    + datetime 1.10.21
+ Moment.js 2.27.0
+ Toastr 2.1.3


## Organização dos arquivos
+ Models

	/app

+ Views

	/resources/views
	
+ Controllers

	/app/Http/Controllers
	
+ js

	/public/js
	
+ css

	/public/css



## Execução
	
Acessar o sistema em https://desafiooliveiratrustrm.000webhostapp.com/

Ou, para rodar localmente:

1. **Criar o banco de dados**

    + Na raíz do projeto:
    
	```
	php artisan migrate
	```
    
    + Ou rodar o script de criação do banco em /dados/script-criacao-bd.sql

2. **Verificar configurações**

Abrir o arquivo /.env e alterar APP_URL, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME e DB_PASSWORD de acordo com os parâmetros locais da máquina.

3. **Instalar depêndencias do Node**

```
npm install
```
	
4. **Rodar**

Na raiz do projeto:

```
php artisan serve
```

