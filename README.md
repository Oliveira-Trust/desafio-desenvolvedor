# Desafio Oliveira Trust

> Para verificar as aitividades programadas para esse desafio, acesse o arquivo [ACTIVITY.md](./ACTIVITY.md):

## 💻 Pré-requisitos

Antes de começar, verifique se você atendeu aos seguintes requisitos:
* Composer;
* Docker;
* Npm;
* Git.

## 🚀 Instalação

Para instalar o projeto, siga estas etapas:

### Navegue até a aplicação
```
cd currency_app
```

### Copie o arquivo exemplo de variáveis de ambiente
```
cp .env.example .env
```

### Instale as dependências de package.json
```
npm install
```

### Compile os assets da aplicação
```
npm run build
```

### Execute o projeto
```
docker-compose up
```

### Alimentar banco de dados
```
docker exec app php artisan migrate:fresh --seed
```

### Gerar key
```
docker exec app php artisan key:generate
```

> O usuário criado para utilizar o sistema foi:<br /><br />
> **E-mail:** usuario@teste.com<br />
> **Senha:** 12345678<br /><br />
> No entanto, é possível cadastrar um novo usuário para acessar o sistema

### Envio de e-mail
> Para tratar os e-mails, o serviço mailhog pode ser acessado na porta 8025.