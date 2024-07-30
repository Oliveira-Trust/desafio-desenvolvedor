# Currency Converter

## Requisitos

- PHP 8.2+
- Composer
- Node.js
- NPM
- MySQL

## Documentação
- [Laravel 11 Documentation](https://laravel.com/docs/11.x)
- [Vue 3 Documentation](https://v3.vuejs.org/guide/introduction.html)
- [Inertia.js Documentation](https://inertiajs.com/)
- [Vuetify Documentation](https://vuetifyjs.com/en/getting-started/installation/)

## Instalação

1. Clone o repositório:
    ```sh
    git clone https://github.com/SeuUsuario/SeuRepositorio.git
    cd SeuRepositorio
    ```

2. Instale as dependências do PHP:
    ```sh
    composer install
    ```

3. Instale as dependências do Node.js:
    ```sh
    npm install
    ```

4. Copie o arquivo `.env.example` para `.env`:
    ```sh
    cp .env.example .env
    ```

5. Configure as variáveis de ambiente no arquivo `.env` conforme necessário.

6. Gere a chave da aplicação:
    ```sh
    php artisan key:generate
    ```

7. Configure o banco de dados no arquivo `.env` e execute as migrações:
    ```sh
    php artisan migrate
    ```

## Executando o Projeto

1. Inicie o servidor de desenvolvimento:
    ```sh
    php artisan serve
    ```

2. Em outra aba do terminal, inicie o Vite:
    ```sh
    npm run dev
    ```

3. Acesse o projeto no navegador:
    ```
    http://localhost:8000
    ```
