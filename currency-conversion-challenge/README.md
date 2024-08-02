## Documentação passo a passo para inicializar projeto e realizar os testes

### Acesse a pasta `/currency-conversion-challenge`:

    cd currency-conversion-challenge

### Crie .env a partir da .env example

    cp .env.example .env 

### Configurar dados do banco na .env.
```
    - Dados do Banco PostgreSQL

    DB_CONNECTION=pgsql
    DB_HOST=postgres
    DB_PORT=5432
    DB_DATABASE=postgres
    DB_USERNAME=root
    DB_PASSWORD=root
```

### Configurar email SMPT:
```
- Você deve acessar o link ( https://myaccount.google.com/apppasswords? )  para criar a senha app e usar no MAIL_PASSWORD.

- No campo nome do app insira: SMTP GMAIL
- Será gerado uma senha, copie e cole no campo MAIL_PASSWORD da .env

- Dados de config da .env do mail:

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_ENCRYPTION=tls
    MAIL_USERNAME=seu_email_gmail
    MAIL_PASSWORD=senha_app
    MAIL_FROM_ADDRESS=seu_email_gmail
    MAIL_FROM_NAME="${APP_NAME}"
```

### Criar os containers
```
docker compose exec application composer install

- Execute os containers

    docker compose up -d

- Instale o composer

    docker compose exec application composer install

- Alterar permissão do diretório storage

    docker compose exec application chown -R www-data:www-data /var/www/

- Crie o arquivo de logs do laravel

    sudo touch storage/logs/laravel.log

- Gerar a chave da aplicação

    docker compose exec application php artisan key:generate

- Execute as migrations

    docker compose exec application php artisan migrate

- Instale o npm

    docker compose exec application npm install

- Execute o Build do front

    docker compose exec application npm run build

- Rode as filas

    docker compose exec application php artisan queue:work
```

### Como testar:
- Vídeos de demonstração de testes: https://www.loom.com/share/6b28616135c84918a154a792ff51dab9?sid=55f0ffd2-408d-40fd-ab8b-6b8cef5fe0af
