## Desafio Oliveira Trust

### Tecnologias utilizadas
- [Laravel 9](https://laravel.com/docs/9.x)
- [PHP 8.1](https://www.php.net/manual/pt_BR/index.php)
- [Docker](https://docs.docker.com/get-docker/)

### Passo a Passo

Clone o repositório
```sh
git clone https://github.com/rammonfelip/desafio-ot.git
```
Faça uma cópia do arquivo .env.example
```sh
cp .env.example .env
```
Rode o comando para subir os containers
```sh
docker-compose up -d
```

Agora será necessário acessar o container para instalar os arquivos de configuração do Laravel.
```sh
docker exec -it oliveira-trust-app composer install
```
```sh
docker exec -it oliveira-trust-app php artisan migrate
```
```sh
docker exec -it oliveira-trust-app php artisan db:seed
```

A aplicação já pode ser acessada pelo endereço [http://localhost:8080]()

A Seeder irá gerar alguns dados para a aplicação. Alguns usuários foram inseridos para teste da aplicação

| Email | Senha |
|-------|-------|
|admin@oliveiratrust.com| admin@oliveiratrust.com |

- Foi utilizado o pacote de autenticação do Laravel
- As formas de pagamento e taxas de valores são configuraveis no menu *Admin*
- A cada transação é registrado no banco e pode ser consultado no menu *Histórico*
