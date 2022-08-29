<p>
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQIAOtqQ5is5vwbcEn0ZahZfMxz1QIeAYtFfnLdkCXu1sqAGbnX" width="300">
 </p>

## Desafio para candidatos à vaga de Desenvolvedor PHP (Jr/Pleno/Sênior).
Olá caro desenvolvedor, nesse teste analisaremos seu conhecimento geral e inclusive velocidade de desenvolvimento. Abaixo explicaremos tudo o que será necessário.

## Instruções:
O desafio consiste em implementar uma aplicação Web utilizando algum framework PHP, e um banco de dados relacional MySQL ou Postgres, a criação das tabelas é livre para sua implementação.

Você vai criar uma aplicação de cadastro de pedidos de compra, a partir de uma modelagem inicial, com as seguintes funcionalidades:

+ CRUD de clientes.
+ CRUD de produtos.
+ CRUD de pedidos de compra, com status (Em Aberto, Pago ou Cancelado).
  + Cada CRUD:
    + deve ser filtrável e ordenável por qualquer campo.
    + deve possuir formulários para criação e atualização de seus itens.
    + deve permitir a deleção de qualquer item de sua lista.
    + Barra de navegação entre os CRUDs.
    + Links para os outros CRUDs nas listagens (Ex: link para o detalhe do cliente da compra na lista de pedidos de compra)

## Tecnologias a serem utilizadas
* HTML
* CSS
* Javascript
* PHP (Laravel, Yii, Lumen, etc...)

## Entrega:
Para iniciar o teste, faça um fork deste repositório, crie uma branch com o seu nome completo e depois envie-nos o pull request. Se você apenas clonar o repositório não vai conseguir fazer push e depois vai ser mais complicado fazer o pull request.

Envie também seu LinkedIn ou currículo para vagas@oliveiratrust.com.br.

## O que vamos avaliar:
- Legibilidade do código
- Modularização
- Lógica para aplicar a regra de négocio
- Utilização da API

## Instruções para o desafio:
Você vai implementar uma aplicação que faça a conversão da nossa moeda nacional para uma moeda estrangeira, aplicando algumas taxas e regras, no final da conversão o resultado deverá ficar em tela de forma detalhada.

Pode utilizar qualquer API para conversão de valores, mas recomendamos essa aqui: https://docs.awesomeapi.com.br/api-de-moedas pela facilidade e boa documentação.

## O Desafio:
O usuário precisa informar 3 informações em tela, moeda de destino, valor para conversão e forma de pagamento. A nossa moeda nacional BRL será usada como moeda base na conversão.

### As Regras de négocio:
- Moeda de origem BRL;
- Informar uma moeda de compra que não seja BRL (exibir no mínimo 2 opções);
- Valor da Compra em BRL (deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00)
- Formas de pagamento (taxas aplicadas no valor da compra e aceitar apenas as opções abaixo)
  - Para pagamentos em boleto, taxa de 1,45%
  - Para pagamentos em cartão de crédito, taxa de 7,63%
- Aplicar taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00, 
essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento.

### Exemplos de entrada:
- Moeda de origem: BRL (default)
- Moeda de destino:
  - Exemplo: USD, BTC, ...
- Valor para conversão:
  - Exemplo: 5.000,00, 1.000,00, 70.000,00, ...
- Forma de pagamento:
  - Boleto ou Cartão de Crédito

### Exemplo de funcionamento:

#### Parâmetros de entrada:
- Moeda de origem: BRL (default)
- Moeda de destino: USD
- Valor para conversão: 5.000,00
- Forma de pagamento: Boleto

#### Parâmetros de saída:
- Moeda de origem: BRL
- Moeda de destino: USD
- Valor para conversão: R$ 5.000,00
- Forma de pagamento: Boleto
- Valor da "Moeda de destino" usado para conversão: $ 5,30
- Valor comprado em "Moeda de destino": $ 920,18 (taxas aplicadas no valor de compra diminuindo no valor total de conversão)
- Taxa de pagamento: R$ 72,50
- Taxa de conversão: R$ 50,00
- Valor utilizado para conversão descontando as taxas: R$ 4.877,50

### Critério de aceitação:
Deve ser possível escolher uma moeda estrangeira entre pelo menos 2 opções sendo o seu valor de compra maior que R$ 1.000 e menor que R$ 100.000,00
e sua forma de pagamento em boleto ou cartão de crédito tendo como resultado o valor que será adquirido na moeda de destino e as taxas aplicadas;

### Bônus:
* Enviar cotação realizada por email;
* Autenticação de usuário;
* Histórico de cotações feita pelo usuário;
* Uma opção no painel para configurar as taxas aplicadas na conversão;

## Informações úteis da api:
- Conversão BRL para USD
    - https://economia.awesomeapi.com.br/json/last/BRL-USD
- Moedas para conversão
    - https://docs.awesomeapi.com.br/api-de-moedas#moedas-com-conversao-para
- Tradução das moedas
    - https://economia.awesomeapi.com.br/json/available/uniq
- Combinações possíveis
    - https://economia.awesomeapi.com.br/json/available
- Legendas
    - https://docs.awesomeapi.com.br/api-de-moedas#legendas

### Boa sorte! 🚀
