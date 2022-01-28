### Configurações utilizadas

- Node: v10.19.0
- NPM: v6.14.4


- Laravel 7.x
- PHP 7.4
- Composer 2.2.5


- MySQL 5.7

### Instruções para rodar o projeto

Rodar o projeto no Docker \
``1. docker-compose up -d``

Copiar o .env.example \
``2. docker exec desafio-desenvolvedor_php-fpm_1 cp .env.example .env`` 

Instalar as dependências com Composer \
``3. docker exec desafio-desenvolvedor_php-fpm_1 composer install``

Gerar a chave \
``4. docker exec desafio-desenvolvedor_php-fpm_1 php artisan key:generate``

Gerar as migrations \
``5. docker exec desafio-desenvolvedor_php-fpm_1 php artisan migrate``

Baixar as dependências com NPM \
``6. docker exec desafio-desenvolvedor_php-fpm_1 npm install``

Compilando javascript \
``7. docker exec desafio-desenvolvedor_php-fpm_1 npm run dev``

Rodar os testes unitários e de integração. Caso queira \
``7. docker exec desafio-desenvolvedor_php-fpm_1 php artisan test``

Acesse o projeto: **localhost:8080**

## Envio de Email
Foi feita classe para envio de email, conseguimos fazer envio no histórico de cotações. \
Entretanto foi utilizado o **Mailtrap**, foi deixado previamente configurado em minha conta,
Porém caso queira modificar:\
``
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=7ca90dab4e4837
MAIL_PASSWORD=deb8cc043fc904
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="Oliveira Trust"
``

**É recomendado que todos os campos sejam preenchidos caso alterado**