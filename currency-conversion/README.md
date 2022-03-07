# conversionproject

Este projeto tem como objetivo converter uma moeda e aplicar as taxas necessárias.

## Começando

Para executar o projeto, será necessário possuir:

- PHP 8.x
- Laravel 8
- Composer
- Node
- Npm

## Construção

Para construir o projeto, executar os comando abaixo:
<br />
<br />

- Baixar todas as dependências do projeto:
```shell
composer install
```

- Baixar todas as dependências node do projeto:
```shell
npm install
```
- Criar um arquivo .env a partir do .envexample

- Executar:
```shell
npm run dev
```

- Executar:
```shell
php artisan serve
```

## Features
O projeto apresenta na sua única tela, um formulário com os campos de valor a ser convertido, moeda origem (Real BRL), moeda destino e método de pagamento.
Ao clicar no botão "Converter", as regras de taxas são aplicadas e o resultado é mostrado em tela.
<br /><br />
