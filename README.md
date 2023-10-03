# Desafio Oliveira Trust

O desafio foi desenvolvido em PHP utilizando o framework CakePHP e banco de dados MySQL. Para execução do desafio foi configurado ambiente de desenvolvimento em containers utilizando Docker.

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
compose install
```

### Instale as dependências de package.json
```
npm install
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

### Envio de e-mail
> Para tratar os e-mails, o serviço mailhog pode ser acessado na porta 8025.