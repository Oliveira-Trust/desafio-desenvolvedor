## PASSO A PASSO PARA CONFIGURAR O PROJETO

- Navegue até a raiz do projeto /desafio-desenvolvedor/desafio.
- Rode o comando composer install
- Crie um arquivo .env
- Copie o conteúdo do arquivo .env-example para o arquivo .env
- Gere a chave com o comando php artisan key:generate
- Processe as migrations com o comando php artisan migrate
- Rode as seeders com o comando php artisan db:seed
- Rode o comando php artisan serve para startar o projeto

Obs: o login para acesso é o e-mail dos usuários gerado na seeder e todas as senhas estão padrão como "12345678".

## CONFIGURAÇÃO DE E-MAIL

Para o envio de cotação via e-mail é necessário realizar algumas configurações necessárias no arquivo .env, o servidor que utilizei para testes foi o "Mailtrap".

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=cotacao@oliveiratrust.com.br
MAIL_FROM_NAME="${APP_NAME}"

## CONFIGURAÇÃO DE BANCO DE DADOS

Adicionar no arquivo .env as configurações para banco de dados

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desafio-desenvolvedor
DB_USERNAME=
DB_PASSWORD=
