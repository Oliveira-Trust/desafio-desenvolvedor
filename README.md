# Teste para Backend PHP

## Tecnologias Utilizadas

- **Laravel 11.x**: Framework PHP robusto e escalável.
- **Blade**: Motor de template nativo do Laravel utilizado para o frontend.
- **Laravel Breeze**: Implementação simples e leve de autenticação para aplicações Laravel.
- **Laravel Sail**: Ambiente de desenvolvimento local utilizando Docker.
- **MySQL**: Banco de dados utilizado no projeto.
- **Flowbite**: Biblioteca de componentes UI.

## Instalação

Para configurar este projeto localmente utilizando o Laravel Sail, siga os passos abaixo:

1. Clone o repositório:
2. Instale as dependências do Composer:
    ```bash
    composer install
    ```
3. Copie o arquivo `.env.example` para `.env` e configure suas variáveis de ambiente:
   ```bash
   cp .env.example .env
   ```
4. Gere a chave da aplicação:
    ```bash
    php artisan key:generate
    ```
5. Instale o Laravel Sail:
    ```bash
    composer require laravel/sail --dev
    ```
6. Publique o arquivo de configuração do Sail:
    ```bash
    php artisan sail:install
    ```
7. Inicialize os containers Docker do Sail:
    ```bash
    ./vendor/bin/sail up
    ```
8. Execute as migrações:
    ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```
9. Execute npm run:
    ```bash
   npm run dev
   ```
## Uso 
Os seeders criam os métodos de pagamento e também 2 usuários

- test@example.com
- admin@example.com

Ambos com senha 123

### Login
O path incial "/" leva a tela padrão de login do framework, ao realizar o login o comportamento será:

- user test@example.com - dashboard para cotações
- user admin@example.com - dashboard adminitrativo de taxas

### Register
Para registrar um novo usuário:
<pre>/register</pre>

### Email de cotação
Rodar o queue
```bash
./vendor/bin/sail php artisan queue:work
```
A mensagem será gravada no log do Laravel, o serviço de envio não foi implementado por ser um teste.

