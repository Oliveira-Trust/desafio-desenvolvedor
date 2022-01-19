
## Teste para vaga de desenvolvedor PHP 

Após ca clonagem do projeto execute o procedimento abaixo para execução!

> $ composer install


Crie um banco de dados no SGBD Mysql com o nome *OliveiraTrust* 

Deve efetuar alterações nos paramatros abaixo do arquivo .env 

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=OliveiraTrust
DB_USERNAME="<usuário do mysql>"
DB_PASSWORD="<senha do usuário mysql>"/

```

Para o envio de e-mail através da fila Queue altere o parâmento abaixo

```
QUEUE_CONNECTION=database

```

Execute a migração para criar as tabelas de dados

> $ php artisan serve

Na tabela rates deve ser populada com os valores e taxas de parâmentros de conversão

> $ php artisan db:seed --class=RatesData


O gerenciador de filas QUEUE deve ser executado em background através da aplicação *Supervisor* ou atravez do comando:

> php artisan queue:work

Para  testar  a ferramenta insira o comando :

> php artisan server

Para criar um novo usuário deve utulizar a URL:

> http://127.0.0.1:8000/register

Agradeço desde já a oportunidade de participar do processo seletivo. 

Att.

Marcelo Bezerra
