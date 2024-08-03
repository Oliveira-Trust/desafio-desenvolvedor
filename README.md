# Desafio Oliveira Trust

Este projeto é uma aplicação de conversão de moeda desenvolvida utilizando Laravel para o back-end e Vue.js com Vite para o front-end. A aplicação permite que os usuários convertam BRL para outras moedas, aplicando regras de negócios específicas, incluindo métodos de pagamento e taxas de conversão.

## 💻 Pré-requisitos

Antes de começar, verifique se você atendeu aos seguintes requisitos:
* Composer;
* Docker;
* Npm;
* Git.

## 🚀 Instalação

Para instalar o projeto, siga estas etapas:

### Navegue até a aplicação backend
```bash
cd currency-api
```

### Copie o arquivo exemplo de variáveis de ambiente
```
cp .env.example .env
```

### Instale as dependêcnais
```bash
docker exec ot-challenge-api composer install
```

### Execute o projeto
```bash
docker-compose up -d
```

### Gerar key
```bash
docker exec ot-challenge-api php artisan key:generate
```

### Alimentar banco de dados
```bash
docker exec ot-challenge-api php artisan migrate:fresh --seed
```

### Navegue até a aplicação frontend
```bash
cd ../currency-app
```

### Instale as dependências de package.json
```bash
npm install
```

### Execute a aplicação
```bash
npm run dev
```

## Utilizar aplicação


## 🧑‍💻 Usuário de Teste
> O usuário criado para utilizar o sistema é:<br /><br />
> **E-mail:** david@example.com<br />
> **Senha:** password

### Envio de e-mail
> Para tratar os e-mails, o serviço mailhog pode ser acessado na porta 8025.