# DESAFIO OLIVEIRA TRUST
## _Desenvolvido por Lucas Candido_

Este desafio foi desenvolvido para vaga de Desenvolvedor Back-End Laravel Pleno para empresa Oliveira Trust.

## RECURSOS

- Conversão de moeda em tempo real
- Histórico de operações realizadas
- Autenticação por usuário

## Tecnologias

Tecnologias utilizadas para o desenvolvimento:

- [Laravel] - Laravel é um framework de aplicação web com sintaxe expressiva e elegante.
- [ReactJS] - O React é uma biblioteca JavaScript de código aberto com foco em criar interfaces de usuário em páginas web.
- [JWT] - O JSON Web Token é um padrão da Internet para a criação de dados com assinatura opcional e/ou criptografia cujo payload contém o JSON que afirma algum número de declarações.
- [MySQL] - O MySQL é um sistema de gerenciamento de banco de dados, que utiliza a linguagem SQL como interface.

## Instalação

O desafio foi desenvolvido nas seguintes versões:
- [Laravel] - 8.80.0
- [PHP] - 7.4.16
- [Composer] - 2.0.12

Instale as dependências do projeto com o composer.
O arquivo .env foi removido do gitignore para que as configurações sejam feitas mais rapidamente.

```sh
composer update
```

Após todas as dependências serem instaladas, vamos gerar uma nova chave de API para a aplicação.

```sh
php artisan key:generate
```

Esta aplicação utiliza JWT para realizar autenticação por meio de um token assinado que autentica uma requisição web.
Então precisamos gerar uma chave que será usada para assinar seus tokens.

```sh
php artisan jwt:secret
```

Agora vamos criar o banco de dados e inserir alguns dados iniciais.

```sh
//Este comando ira criar um banco de dados se o mesmo não existir
php artisan db:create desafio_oliveira_trust

//Criando as tabelas no banco de dados
php artisan migrate

//Inserindo alguns dados iniciais
php artisan db:seed
```

Após o banco ser criado e todas as configurações feitas, vamos iniciar o projeto.

```sh
php artisan serve
```

## Estrutura do Front-End

O Front-End foi desenvolvido em ReactJS, e todo o Javascript e CSS ficam na pasta /Resources.

| Tela | Arquivo |
| ------ | ------ |
| Login | /resources/js/component/Login.js [JS] - /resources/sass/login.scss [css/scss]  |
| HomePage | /resources/js/component/HomePage.js [JS] - /resources/sass/home-page.scss [css/scss] |
| Operações (Component) | /resources/js/component/Operation.js [JS] - /resources/sass/home-page.scss [css/scss] |
| Histórico (Component) | /resources/js/component/Historic.js [JS] - /resources/sass/home-page.scss [css/scss] |


## Contato

Caso tenham alguma duvida, segue minhas redes:

- [Linkedin] - https://www.linkedin.com/in/lucascandido-ti/


