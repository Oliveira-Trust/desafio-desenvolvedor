# Desafio Desenvolvedor

## 🚀 Começando

Desafio para candidatos à vaga de Desenvolvedor PHP (Jr/Pleno/Sênior).
Olá caro desenvolvedor, nosso principal objetivo é conseguir ver a lógica implementada independente da sua experiência, framework ou linguagem utilizada para resolver o desafio. Queremos avaliar a sua capacidade em aplicar as regras de négocios na aplicação, separar as responsabilidades e ter um código legível para outros desenvolvedores, as instruções nesse projeto são apenas um direcional para entregar o desafio mas pode ficar livre para resolver da forma que achar mais eficiente. 🚀

Não deixe de enviar o seu teste mesmo que incompleto!

## 📋 Stack Utilizado

De que coisas você precisa para instalar o software e como instalá-lo?

* [Laravel 8](https://laravel.com/docs/8.x)
* [Vue 3](https://v3.vuejs.org/)
* [PrimeVue 3](https://www.primefaces.org/primevue/showcase/#/setup)

## Pré Requisitos

* [Composer](https://getcomposer.org/)
* [NPM](https://www.npmjs.com/)

## 🔧 Instalação

Após clonar o projeto do reposítorio, entre na pasta do seu projeto, copie o arquivo **.env-example** para **.env**

```sh
cp .env.example .env
```

Primeiro rodar o composer

Diga como essa etapa será:

```sh
composer install
```

E logo em seguida, instalar o npm:

```sh
npm install
```

Depois que Laravel e o Vue estiver instalado, configurar o arquivo **.env**:

Para conexão do banco:

````
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
````

Para envio de e-mail **(SMPT)**: 
````
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
````

Depois que conectar o banco, utilizar o comando para subir as entidades:
````sh
php artisan migrate
````

Para gerar uma nova chave de aplicação: 
````sh
php artisan key:generate
````

Para limpar o cache depois de configurar o **.env**:
```
php artisan cache:clear
```

Agora chegou a hora de inicializar o sistema:

Para subir o servidor do laravel, usar o comando **(Terminal 1)**:
```sh
php artisan serve
```
Caso queira trocar de porta: 
````sh
php artisan serve --port=3000
````

### Comandos para desenvolvimento

Alguns comandos são essenciais para o desenvolvimento:

Para identar os controllers de uma forma correta:
```ssh
vendor/bin/phpcs --standard=PSR2 diretorio
```

Compilar corretamente todo CSS e JS **(Terminal 2)**:
```
npm run dev && npm run watch-poll
```

## ✒ Autores

**Desafio Desenvolvedor** - [Desafio Desenvolvedor](https://github.com/thainan76/desafio-desenvolvedor)

---
⌨️ com ❤️ por [Thainan Prado](https://github.com/thainan76) 😊
