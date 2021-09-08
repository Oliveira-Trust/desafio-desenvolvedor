<p>
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQIAOtqQ5is5vwbcEn0ZahZfMxz1QIeAYtFfnLdkCXu1sqAGbnX" width="300">
 </p>
 
## Desafio para candidatos à vaga de Desenvolvedor PHP (Jr/Pleno/Sênior).
Olá caro desenvolvedor, nesse teste analisaremos seu conhecimento geral e inclusive velocidade de desenvolvimento. Abaixo explicaremos tudo o que será necessário.

## Instruções:
Você vai implementar uma aplicação que faça a conversar da nossa moeda nacional para outra moeda, aplicando algumas taxas e regras, no final da conversão o resultado deverá ficar em tela de forma detalhada.
Pode utilizar qualquer API para conversão de valores, mas recomendamos essa aqui: https://docs.awesomeapi.com.br/api-de-moedas pela facilidade e boa documentação.

## O Desafio:
O usuário precisa informar a moeda de destino para conversão sendo sempre a origem a nossa moeda nacional BRL.

### As Regras de négocio:

- Moeda de origem BRL;
- Informar uma moeda de compra que não seja BRL;
- Valor da Compra em BRL (deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00)
- Formas de pagamento (taxas aplicadas no valor da compra e aceitar apenas as opções abaixo)
  - Para pagamentos em boleto, taxa de 1,45%
  - Para pagamentos em cartão de crédito, taxa de 7,63%
- Aplicar taxa pela conversão de 2% para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00, 
essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento.

### Parâmetros de entrada:
- Moeda de origem: BRL (default)
- Moeda de destino:
  - Exemplo: USD, BTC, ...
- Valor para conversão:
  - Exemplo: 5.000,00, 1.000.00, 70.000,00, ...
- Forma de pagamento:
  - Boleto ou Cartão de Crédito

### Resultado esperado em tela:
- Moeda de origem: BRL
- Moeda de destino: USD
- Valor para conversão: R$ 5.000,00
- Forma de pagamento: Pagamento em boleto
- Valor comprado em USD: $ 921,19 (taxas aplicadas no valor de compra diminuindo no valor total de conversão)
- Taxa de pagamento: R$ 72,50
- Taxa de conversão: R$ 50,00
- Valor utilizado para conversão descontando as taxas: R$ 4.877,50


### Critério de aceitação:

Deve ser possível informar uma moeda estrangeira, o valor de compra maior que R$ 1.000 e menor que R$ 100.000,00
e a forma de pagamento em boleto ou cartão de crédito tendo como resultado o valor que será adquirido na moeda de destino e as taxas aplicadas;


## Tecnologias a serem utilizadas
* HTML
* CSS
* Javascript
* PHP (Laravel, Yii, Lumen, etc...)

## Entrega:
Para iniciar o teste, faça um fork deste repositório, crie uma branch com o seu nome completo e depois envie-nos o pull request. Se você apenas clonar o repositório não vai conseguir fazer push e depois vai ser mais complicado fazer o pull request.

Envie também seu LinkedIn ou currículo para vagas@oliveiratrust.com.br.

## Bônus:

* Enviar cotação realizada por email;
* Autenticação de usuário;
* Histórico de cotações feita pelo usuário;
* Uma opção no painel para configurar as taxas aplicadas na conversão;

## Nossa análise
* Organização do código.
* Separação de módulos.
* Legibilidade.
* Comentários.
* Readme.
* Histórico de commits.

# Boa sorte!
