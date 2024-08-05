# Aplicação de Câmbio em Laravel 11

## O projeto utiliza:

```

1. Laratvel 11;
2. composer;
3. boostrap e
4. mysql
```

## Configuração do Ambiente

1. Instalar Laravel 11.

```
composer create-project --prefer-dist laravel/laravel App-Cambio
```
2.Configurar as dependências necessárias.

```
Instalar o GuzzleHTTP
```
3. Cria o controlador

Controlador para processar a conversão e calcular as taxas  e 
Integração com a API de Moedas.

Configurar a chamada para a API de moedas da AwesomeAPI para obter a taxa de câmbio atual.
Validação dos Dados.

Validação para garantir que o valor de compra esteja entre R$ 1.000,00 e R$ 100.000,00.
Validação para as formas de pagamento.
Aplicação das Taxas

Implementar as regras de negócio para aplicar as taxas de pagamento e de conversão.
Exibição dos Resultados


```

php artisan make:controller ConversaoController
```

4. Criação das Rotas



5. Craindo as Views

```
php artisan make:view conversao.blade
```
Aqui foi adicionado um Script jQuery para detectar mudanças na seleção da moeda de destino e fazer uma chamada AJAX para obter a cotação do dia da API.
e
```
php artisan make:view resultado.blade 
```