## Ambiente utilizado

Ambiente construindo utilizando container, via docker.

> Mysql 5.7.24

> Nginx 1.16

> php 7.2.19

> Laravel 5.8

> Swagger php 2.0

## Setup initial

Execute os seguintes passos abaixo, em um console, após clonar esse repositório:

> composer install

> cp envvars\local.env .env

> php artisan key:generate

> php artisan l5-swagger:generate

Agora, configure o arquivo `config/database.php` e defina o nome da base de dados.
Lembre-se que o usuário necessitará de acessos *root* para criar as tabelas.

> php artisan migrate:install

> php artisan migrate

Se ocorreu tudo bem, as tabelas foram criadas no banco definido no `config/database.php`.

Agora, execute o comando abaixo para criar registros de teste, assim como o 
usuário **admin** para acessar o dashboard.

> php artisan db:seed

Se tudo deu certo, as tabelas de catalog, customer e user foram populadas.

Próximo passo será configurar o dns da api de backend. Acesse o arquivo `config/app.php`
e busque a chave *url_api_endpoint*. 

Existe um paramêtro no .env (URL_API_ENDPOINT) referente 
ao endereço local. Altere nesse arquivo também, caso seja diferente do de produção 
ou remove a linha para herdar o do config/app.php.

Feito isso, rode o seguinte comando no terminal:

> php artisan config:clear

Agora vá ao navegador e acesso o sistema, utilizando as seguintes credências de acesso:

> **login:** admin@admin.com

> **password** admin123

## Documentação das APIS

O sistema foi construindo separando front-end e back-end, mesmo que ambos esteja
no mesmo repositório. 

Foi criado uma abstração que facilitará essa separação no futuro. 
A abstração foi feita em cima da classe: *App\MyClass\FactoryApis*

Url da documentação: `_DNS_/api/documentation`
