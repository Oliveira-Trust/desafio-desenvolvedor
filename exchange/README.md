## Projeto com todos os pontos solicitados + bônus

## Como rodar

- Duplique o arquivo .env.example e renomeie para .env
- Dentro da pasta `exchange`
   - Execute o comando `npm install`
   - Execute o comando `npm run build`  
   - Execute o comando `composer install`
   - Execute o comando `php artisan serve`
   - Acesse o servidor 

## Considerações sobre o email

- Para realizar o envio de email, usei o [MailTrap.io](https://mailtrap.io/home) como teste (uma plataforma para teste de email). Crie um conta gratuitamente na plataforma e coloque nas váriavéis de ambiente abaixo.
    - MAIL_MAILER=smtp
    - MAIL_HOST=sandbox.smtp.mailtrap.io
    - MAIL_PORT=2525
    - MAIL_USERNAME=//your username
    - MAIL_PASSWORD=// your password
- É possivel usar outras provedores de email, como o Gmail, basta colocar nas váriaveis de ambiente o usuário, senha e o host.
