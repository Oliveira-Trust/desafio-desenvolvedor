
## CurrencyConvert

Esse projeto foi desenvolvido em Laravel, com auxilio do Laravel UI e Vite

1. Instalar as dependências do composer
```bash
composer install
```

2. Instalar as dependências do npm
```bash
npm install
```

3. Copiar o env.example e alterar
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

# e

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```
4. Gerar a chave do Laravel
```bash
php artisan key:generate
```
5. Criar banco de dados
```bash
php artisan migrate
```
6. Atualizar os seeders
```bash
php artisan db:seed
```
7.  Rodar o front:

```bash
npm run dev
# or
yarn dev
```

8.  Rodar o servidor (em um outro terminal):

```bash
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000) no seu navegador e seja feliz


## Observações

Foram implementados todos os itens incluindo os bônus

- [Demonstração](https://drive.google.com/file/d/1PtB1yHRQkECjyumGngKbvXCG03EiZhFN/view) - vídeo de demonstração do sistema
