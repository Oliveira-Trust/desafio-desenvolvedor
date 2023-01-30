### API DESAFIO

#### Resumo

Implementação de uma aplicação e API simples faz a conversão da nossa moeda nacional para uma moeda estrangeira, 
aplicando algumas taxas e regras, no final da conversão o resultado deverá ficar em tela de forma detalhada.

Para conversão dos valores foi utilizada a https://docs.awesomeapi.com.br/api-de-moedas pela facilidade e boa documentação.

#### Premissas

- Implementar uma API REST, registrando um histórico das operações realizadas por usuário;
- Autenticação de usuários por token (Sanctum);
- Consulta via API das operações filtradas para o usuário corrente;
- Implementar testes automatizados;
- Acesso via web usando Filament;

#### Regras de negório

- Moeda origem sempre BRL (Real brasileiro)
- Valores a converter entre R$ 1.000,00 e R$ 100.000,00
- Forma de pagamento pode ser boleto (Slip) o cartão de crédito (Card)
- Taxas por método de pagamento:
  - Para pagamentos em boleto, taxa de 1,45%
  - Para pagamentos em cartão de crédito, taxa de 7,63%
- Taxa por valor de 2% pela conversão para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00,
  essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento.

#### Instalação

1. Clonar repositório em um diretório local e acessá-lo;
2. Rodar ```composer install``` para instalar dependências;
3. Copiar .env.example para .env
4. Editar o arquivo .env para configurar (vem pronto para rodar em sqlite)
5. Criar banco de dados sqlite para testes: ```touch database_test.sqlite```
6. Rodar as migrações: ```php artisan migrate```
7. Rodar os testes: ```php artisan test```

Pronto para ser utilizado.

#### Operação como API

O aplicativo pode funcionar como API ou com interface web. 
Se estiver usando Laravel Valet, o endereço é ```desafio-desenvolvedor.test```, se não, rodar o servidor de
desenvolvimento do Laravel ( ```php artisan serve```) e acessar em ```127.0.0.1:8000```.

Foi incluido o arquivo ```insomnia_test.json``` para ser importado no insomnia para documentar a API, como abaixo:

![Alt text](insomnia-test.png?raw=true "Insomnia")

**Registrar novo usuário**

Payload e retornos.

POST [address]/api/register-user

```json
{
  "email": "aurora@dog.com",
  "name": "Aurora",
  "password": "password"
}

{
  "error": "",
  "token": "9|rsi42D0F6NP3vjVtARXedSUx9dpbQ9FWhtfqKIMD"
}
```

**Autenticar usuário**

POST [address]/api/login-user

```json
{
  "email": "aurora@dog.com",
  "password": "password"
}

{
  "error": "",
  "token": "9|rsi42D0F6NP3vjVtARXedSUx9dpbQ9FWhtfqKIMD"
}
```

**Solicitar uma Conversão**

POST [address]/api/exchange (usando o Bearer token gerado na autenticação
)

```json
{
    "currency": "EUR",
    "payment_method": "Card",
    "ammount": 1000
}

{
  "currency": "EUR",
  "method": "Card",
  "ammount": 1000,
  "ammount_fee": 20,
  "method_fee": 76.3,
  "net_ammount": 903.7,
  "exchange_rate": 5.5484,
  "converted_ammount": 162.88,
  "user_id": 3,
  "updated_at": "2023-01-30T14:43:52.000000Z",
  "created_at": "2023-01-30T14:43:52.000000Z",
  "id": 9
}
```

**Listar as Conversões**

GET [address]/api/exchange
usando o Bearer token gerado na autenticação
Filtra para mostrar apenas os dados do usuário autenticado
em ordem decrescente de data.

```json
{
  "data": [
	{
		"currency": "EUR",
		"method": "Card",
		"ammount": 1000,
		"ammount_fee": 20,
		"method_fee": 76.3,
		"net_ammount": 903.7,
		"exchange_rate": 5.5484,
		"converted_ammount": 162.88,
		"created_at": "2023-01-30T14:43:52.000000Z",
		"user": "aurora@dog.com"
	},
	{
		"currency": "EUR",
		"method": "Slip",
		"ammount": 1000,
		"ammount_fee": 20,
		"method_fee": 14.5,
		"net_ammount": 965.5,
		"exchange_rate": 5.5461,
		"converted_ammount": 174.09,
		"created_at": "2023-01-30T14:40:46.000000Z",
		"user": "aurora@dog.com"
	},
  ]
}
```
#### Operação como Aplicativo


