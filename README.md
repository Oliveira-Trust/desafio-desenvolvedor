# Teste para Backend PHP

## Tecnologias Utilizadas

- **Laravel 11.x**: Framework PHP robusto e escalável.
- **Blade**: Motor de template nativo do Laravel utilizado para o frontend.
- **Laravel Breeze**: Implementação simples e leve de autenticação para aplicações Laravel.
- **Laravel Sail**: Ambiente de desenvolvimento local utilizando Docker.
- **MySQL**: Banco de dados utilizado no projeto.
- **PEST**: Framework de testes para PHP.
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
    ./vendor/bin/sail artisan migrate
    ```
