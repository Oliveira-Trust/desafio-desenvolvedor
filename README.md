# Desafio desenvolverdor Oliveira Trust
Aplicação desenvolvida para o processo seletivo referente ao cargo de desenvolvedor backend na empresa Oliveira Trust.

## Descrição
Implementar uma aplicação que faça a conversão da nossa moeda nacional para uma moeda estrangeira, aplicando algumas taxas e regras, no final da conversão o resultado deverá ficar em tela de forma detalhada.

A aplicação consiste no uso de uma API para retornar a cotaçãon atual da moeda informada no uso da API, em seguida a aplicação irá realizar os tramites internos de taxas e cálculos para informar o valor final a ser investido na compra e também o valor comprado da moeda estrangeira.

## Versões utilizadas para rodar a aplicação
PHP     | Laravel   |Composer   |Sail   |Mysql  |Mailhog    |Redis  |Docker
|-      | -         |-          |-      |-      |-          |-      |-
8.1.13  | 9.45.1    |2.4.4      |1.0.1  |8.0.1  |1.0.1      |7.0.7  |20.10.21

## Sobre da aplicação
+ A aplicação foi desenvolvida utilizando o Laravel Sail
+ A aplicação não possui nenhum frontend, como o objetivo era para backend não foi projetado nenhum frontend mas todas as rotas podem ser utilizadas por qualquer frontend sem problemas.
+ Não fiz a documentação das rotas pelo Swagger, como o tempo foi curto pensei mais na aplicação em sim doque em uma documentação das rotas mas que seria sim muito possível realizar essa documentação com mais tempo.
+ O envio dos email após a cotação está configurado inicialmente para enviar diretamente para o mailhog, mais prático pra trabalhar em desenvolvimento, para ajustes para outro servidor de email só configurar o env para o mesmo.
+ Fiz uso de um Job para realizar todo o cáculo da cotação, tirando assim a responsabilidade sincrona, informando que o Job só será executado caso o retorno da API de cotação retorne algum valor, com isso o fluxo segue e o job e disparado realizando assim o cálculo. Onde o mesmo quando executado persiste os dados e retorna o email para o usuário com todos os detalhes da contação.
+ Para as moedas e tipos de pagamento usei o Enum do Laravel para a manutenção desses dados, basta adicionar ou remover as informações que a validação do form irá ocorrer da mesma forma.
+ Não fiz uso de uma tradução para os textos, deixei todos em inglês mesmo, acredito que fugiria muito do objetivo do teste.
+ Existe rotas para o histórico da convesão para determinando usuário onde o mesmo verifica apenas seus dados, como fiz uso de um Job no momento da conversao não é retornado nenhum dado MAS no histórico do usuário ele retorna todos os dados na moeda que foi convertido.
+ Também existe rotas de configurações das taxas, métodos de pagamentos e moedas.
+ Por fim usei o Laravel Modules (lib) para melhor organizar o projeto separando por módulos.
