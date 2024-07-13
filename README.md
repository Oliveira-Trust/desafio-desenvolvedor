

### Enviroment:

required:
```json
"php": "^8.3",
"composer": "2.7.7"
"node": "20.12.2"
"npm": "10.8.1"
"mysql": "8.0.37"
```

#### Backend:

Composer:

```
php composer.phar install | composer install
```

Env:

```
Copiar, env.example e renomear para .env
```

Mail:
```
Atualizar env com o MailTrap.IO:

## ----  MAILTRAP.IO ---- ##
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=456784c7f7444784dd
MAIL_PASSWORD=***3744
MAIL_ENCRYPTION=null

```

Database:
```
CREATE USER admin@localhost IDENTIFIED BY 'admin';
GRANT ALL ON *.* TO admin@localhost;
FLUSH PRIVILEGES;

CREATE DATABASE currency_converter;

## --- Env --- ##

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=currency_converter
DB_USERNAME=admin
DB_PASSWORD=admin
```


Laravel artisan:

```
> php artisan key:generate
> php artisan migrate
> php artisan seed
```

Vue.js:

```
> npm install
```

Subir ambiente:

```
> php artisan serve
> npm run dev

http://127.0.0.1:8000/
```

#### Scripts

[phpunit]

```
composer unit // Todos os testes
composer unitf // Filter por teste, filter=test_function
```

PHP CS Fixer

```
composer cs-fixer-dry // Visualizar alterações a serem ajustadas
composer cs-fixer // Ajustar e modificar
```


#### Postman
[Collection](https://www.postman.com/rom-mb/workspace/currencyconverter/collection/6885147-4f3359b4-8d3f-40e1-a812-645125ef9348?action=share&creator=6885147)

---

### A Oliveira Trust:
A Oliveira Trust é uma das maiores empresas do setor Financeiro com muito orgulho, desde 1991, realizamos as maiores transações do mercado de Títulos e Valores Mobiliários.

Somos uma empresa em que valorizamos o nosso colaborador em primeiro lugar, sempre! Alinhando isso com a nossa missão "Promover a satisfação dos nossos clientes e o desenvolvimento pessoal e profissional da nossa equipe", estamos construindo times excepcionais em Tecnologia, Comercial, Engenharia de Software, Produto, Financeiro, Jurídico e Data Science.

Estamos buscando uma pessoa que seja movida a desafios, que saiba trabalhar em equipe e queira revolucionar o mercado financeiro!

Front-end? Back-end? Full Stack? Analista de dados? Queremos conhecer gente boa, que goste de colocar a mão na massa, seja responsável e queira fazer história!

#### O que você precisa saber para entrar no nosso time: 🚀
- Trabalhar com frameworks (Laravel, Lumen, Yii, Cake, Symfony ou outros...)
- Banco de dados relacional (MySql, MariaDB)
- Trabalhar com microsserviços

#### O que seria legal você saber também: 🚀
- Conhecimento em banco de dados não relacional;
- Conhecimento em docker;
- Conhecimento nos serviços da AWS (RDS, DynamoDB, DocumentDB, Elasticsearch);
- Conhecimento em metodologias ágeis (Scrum/Kanban);

#### Ao entrar nessa jornada com o nosso time, você vai: 🚀
- Trabalhar em uma equipe de tecnologia, em um ambiente leve e descontraído e vivenciar a experiência de mudar o mercado financeiro;
- Dress code da forma que você se sentir mais confortável;
- Flexibilidade para home office e horários;
- Acesso a cursos patrocinados pela empresa;

#### Benefícios 🚀
- Salário compatível com o mercado;
- Vale Refeição;
- Vale Alimentação;
- Vale Transporte ou Vale Combustível;
- Plano de Saúde e Odontológico;
- Seguro de vida;
- PLR Semestral;
- Horário Flexível;
- Parcerias em farmácias

#### Local: 🚀
Barra da Tijuca, Rio de Janeiro, RJ

#### Conheça mais sobre nós! :sunglasses:
- Website (https://www.oliveiratrust.com.br/)
- LinkedIn (https://www.linkedin.com/company/oliveiratrust/)

A Oliveira Trust acredita na inclusão e na promoção da diversidade em todas as suas formas. Temos como valores o respeito e valorização das pessoas e combatemos qualquer tipo de discriminação. Incentivamos a todos que se identifiquem com o perfil e requisitos das vagas disponíveis que candidatem, sem qualquer distinção.

## Pronto para o desafio? 🚀🚀🚀🚀
https://github.com/Oliveira-Trust/desafio-desenvolvedor/blob/master/vaga.md
