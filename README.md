# Desafio Oliveira Trust

O desafio foi desenvolvido em PHP utilizando o framework CakePHP e banco de dados MySQL. Para execução do desafio foi configurado ambiente de desenvolvimento em containers utilizando Docker. Nas regras de negócio foi informado que deveria ser informado uma moeda de compra que não seja BRL, porém a implementação realizada permite a realização de conversão para todas combinações possíveis disponibilizada na API sujerida para utilização (https://economia.awesomeapi.com.br/json/available). Também foi implementada na tela campo não obrigatório para informar e-mail, caso o usuário esteja logado ele não exibe este campo e envia email para o email cadastrado para o usuário e registra o log da conversão realizada. Caso o usuário não esteja logado, é realizado envio de email para o email informado e não registra log da cotação realizada.

## 💻 Pré-requisitos

Antes de começar, verifique se você atendeu aos seguintes requisitos:
* Docker;
* composer

## Tecnologias utilizadas
* HTML
* CSS
* Javascript (jQuery)
* CakePHP 5.0 Chiffon
* Docker
* MySQL 8.1
* PHP 8.2

## 🚀 Instalação

Para instalar o projeto, siga estas etapas:

### Clone o repositório que contém o source do desafio
```
git clone git@github.com:rogermaciel/desafio-desenvolvedor.git
```

### Instale as dependências da aplicação (application/composer.json)
```
cd application/ && compose install
```

### Criar a estrutura de banco
```
docker exec -it desafio-desenvolvedor-php bin/cake migrations migrate
```

### Popule o banco de dados para configurar usuário de acesso e formas de pagamento
```
docker exec -it desafio-desenvolvedor-php bin/cake migrations seed
```

### Execute o projeto
```
docker-compose up -d
```

> O usuário criado para acessar a área logada da aplicação:<br /><br />
> **E-mail:** rogermaciel@gmail.com<br />
> **Senha:** 1q2w3e4r<br /><br />
> No entanto, é possível cadastrar um novo usuário para acessar o sistema

### URL para testar endpoint de conversão de moeda utilizando postman ou insomnia
```
http://localhost:8888/conversions/convert/json
```

### Exemplo de objeto para executar requisição utilizando método POST
```
{
	"origin_currency":"BRL",
	"destination_currency":"USD",
	"value_to_convert":5000,
	"payment_method_id":2,
	"email" : "rogermaciel@outlook.com"
}
```

### Retorno de sucesso de requisição ao endpoint (http://localhost:8888/conversions/convert/json)
```
{
    "status": 200,
    "data": {
        "origin_currency": "BRL",
        "destination_currency": "USD",
        "value_to_convert": 5000,
        "payment_method": "Cartão de Crédito",
        "destination_currency_conversion_value": 0.1974,
        "destination_currency_purchased_value": 901.8218999999999,
        "payment_tax": 381.5,
        "conversion_tax": 50,
        "conversion_value_without_tax": 4568.5
    },
    "message": "success"
}
```

### Retorno de erro para requisição ao endpoint (http://localhost:8888/conversions/convert/json)
```
{
    "status": 404,
    "data": "",
    "message": "Combinação para conversão indisponível"
}
```

### Dados de configuração Envio de e-mail utilizando Mailhog
> **host:** mailhog<br />
> **port:** 1025<br />
> **username:** null<br />
> **password:** null<br />
> **className:** Smtp<br />

### Dados de configuração acesso ao banco de dados
> **DATABASE:** cakephp<br />
> **USER:** cakephp<br />
> **PASSWORD:** cakephp<br />
> **PORT:** 3306<br />

### Envio de e-mail
> Para tratar os e-mails, o serviço mailhog pode ser acessado na porta 8025.

### URLs de acesso aos serviços configurados e disponíveis no ambiente de teste
> **Acessar a Aplicação:** http://localhost:8888/<br />
> **Acessar o Adminer:** http://localhost:8080/<br />
> **Acessar o Mailhog:** http://localhost:8025/<br />