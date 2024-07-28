## Conversão entre moedas

A conversão é feita atraves do https://economia.awesomeapi.com.br/json/last/BRL-USD

- Para pagamentos via boleto é cobrado a taxa de 1,45%
- Para pagamentos com cartão de crédito é cobrado o valor de 7,63%
- Para coversão de valores abaixo de 3000 e´cobrada taxa de 2% e acima 1%
- Todas as cotações são permitidas emtre os valores 1000 e 100000
- Toda cotação gera um histórico para cada usúario guardado em localstorage

### Tecnologias utilizadas
- Laravel 11
- PHP 8.2
- Bootstrap 4.6
- HTML
- CSS
- Javascript

### Para rodar o projeto

- Clone o projeto 
- Rode `composer install`
- Duplique o arquivo `.env.example` e renomeie para `.env`
- Gere uma nova key com o comando a seguir `php artisan key:generate`
- Depois rode `php artisan migrate` e então `php artisan serve`, o projeto pode ser acessado em `http://127.0.0.1:8000/conversion`