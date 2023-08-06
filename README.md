## Money Conversion
# Projeto feito e testado em PHP version 8.28
Para rodar o projeto primeiramente
1- copie o arquivo .env.example para um arquivo chamado .env
2- instale as dependencias
```bash
$ composer install
```
3- Rode as migrations e a seeder

```bash
# garanta que crie o arquivo de banco de dados, ele vai perguntar ao rodar o comando
$ php artisan migrate
$ php artisan db:seed
```

4 - Rode a aplicação

```bash
$ php artisan serve
```

## Informações importantes
existem 3 rotas

POST /api/login - para realizar o login
body:  este é o unico usuario existente
```JSON
{ "email":"test@example.com","password":"123"}
```

POST api/conversion - para fazer as conversões necessita login use access_token como token para bearer authentication
body
```json
# target_coin: moeda para conversao
# value: valor para converter
# payment_method: modo de pagamento válido apenas bill(boleto) e credit_card(cartão de crédito)
#source_coin: moeda de origem sempre será BRL 
{
	"target_coin": "USD", 
	"value": 1000,
	"payment_method": "bill",
	"source_coin": "BRL"
}
```
RESPOSTA
```json
# target_coin: moeda para conversao
# value: valor para converter
# payment_method: modo de pagamento
# source_coin: moeda de origem 
# payment_tax: taxa de pagamento
# actual_cotation: valor da cotacao na hora da pesquisa
# converted_value: valor comprado ou seja valor na moeda destino já com as taxas retiradas
# convertion_tax: taxa aplicada sobre a conversão

{
	"target_coin": "PEN",
	"source_coin": "BRL",
	"conversion_tax": 20,
	"payment_tax": 76.3,
	"actual_cotation": 1.32,
	"converted_value": 727.27,
	"payment_method": "bill",
	"value": 1000
}
```

GET api/conversion/history - historico de conversões do usuario  necessita login use access_token como token para bearer authentication
RESPOSTA
```json
# target_coin: moeda para conversao
# value: valor para converter
# payment_method: modo de pagamento
# source_coin: moeda de origem
# payment_tax: taxa de pagamento
# actual_cotation: valor da cotacao na hora da pesquisa
# converted_value: valor comprado ou seja valor na moeda destino já com as taxas retiradas
# convertion_tax: taxa aplicada sobre a conversão

{
	"target_coin": "PEN",
	"source_coin": "BRL",
	"conversion_tax": 20,
	"payment_tax": 76.3,
	"actual_cotation": 1.32,
	"converted_value": 727.27,
	"payment_method": "bill",
	"value": 1000
}
```
