# Currency Converter

## Visão Geral
Esta aplicação realiza a conversão de valores da moeda brasileira (BRL) para outras moedas estrangeiras, aplicando taxas específicas de acordo com a forma de pagamento escolhida. A aplicação também possui autenticação de usuário.

## Tecnologias Utilizadas
- Laravel (PHP)
- HTML
- CSS (Bootstrap)
- Javascript

## Instalação
1. Clone o repositório:
    ```bash
    git clone https://github.com/rafaelferreira2312/currency-converter.git
    ```
2. Navegue até o diretório do projeto:
    ```bash
    cd currency-converter
    ```
3. Instale as dependências do Composer:
    ```bash
    composer install
    ```
4. Configure o arquivo `.env` com as informações do banco de dados e outras configurações necessárias.
5. Gere a chave da aplicação:
    ```bash
    php artisan key:generate
    ```
6. Crie o banco de dados:
    ```bash
    CREATE DATABASE currency_converter;
    ```
7. Rode as migrações:
    ```bash
    php artisan migrate
    ```
8. Instale as dependências do NPM e compile os assets:
    ```bash
    npm install
    npm run dev
    ```
9. Inicie o servidor:
    ```bash
    php artisan serve
    ```

## Utilização
1. Acesse a aplicação no navegador:
    ```
    http://localhost:8000
    ```
2. Registre-se ou faça login para acessar a aplicação.
3. Preencha o formulário com as informações necessárias:
    - Moeda de destino (USD ou BTC)
    - Valor para conversão (deve ser entre R$ 1.000,00 e R$ 100.000,00)
    - Forma de pagamento (boleto ou cartão de crédito)
4. Clique em "Converter" para ver o resultado da conversão, incluindo as taxas aplicadas e o valor final na moeda de destino.

## Licença
Este projeto está licenciado sob a licença MIT.
