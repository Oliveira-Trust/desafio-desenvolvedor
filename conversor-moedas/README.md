# Conversor de Moedas

Aplicação para conversão de moedas.

### Como inciar o projeto
- No terminal, dentro do projeto `desafio-desenvolvedor/conversor-moedas` é necessário executar o comando `composer install`
- É necessário realizar uma cópia do `.env.example` e renomear como `.env`, pode ser feito utilizando o comando `cp .env.example .env`
- Após isso, será utilizado o docker para rodar a aplicação, por meio do Laravel/Sail. Execute o comando `./vendor/bin/sail up -d`
- Utilizar o comando `.vendor/bin/sail artisan key:generate` para gerar a APP_KEY da aplicação Laravel.

### Após ter inciado o projeto
- Para ter os dados da api de moedas, é preciso executar o comando `./vendor/bin/sail artisan coin_prices` e para mante-lo atualizando a cada `5 minutos`, utilizar o comando `./vendor/bin/sail artisan schedule:work`, isso iniciará o scheduler, fazendo ele executar o primeiro comando a cada 5 minutos, até que seja cancelado o comando pelo terminal.

## Obrigatório ter instalado no computador:
- PHP 8.1
- Composer
- Docker
