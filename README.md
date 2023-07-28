<p>
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQIAOtqQ5is5vwbcEn0ZahZfMxz1QIeAYtFfnLdkCXu1sqAGbnX" width="300">
 </p>

# Projeto PHP - Conversor de Moedas

## Tecnologias a serem utilizadas
* HTML
* CSS
* Javascript
* PHP (Laravel, Yii, Lumen, etc...)

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

### Bônus:
* Enviar cotação realizada por email;
* Autenticação de usuário;
* Histórico de cotações feita pelo usuário;
* Uma opção no painel para configurar as taxas aplicadas na conversão;


Este é um projeto PHP que implementa um conversor de moedas usando a Clean Architecture. Ele é composto por diversas classes e módulos organizados de forma modular e separada, seguindo as boas práticas de desenvolvimento.

## Funcionalidades

O projeto possui as seguintes funcionalidades:

1. Conversão de Moedas: Permite ao usuário converter um valor de uma moeda para outra. Ele utiliza uma API externa para obter as taxas de câmbio atualizadas.

2. Histórico de Cotações: Mantém um histórico das cotações de moedas realizadas pelos usuários. As cotações são armazenadas em um banco de dados para posterior consulta e análise.

3. Autenticação de Usuários: Permite que os usuários se autentiquem no sistema para acessar funcionalidades restritas.

4. Envio de E-mails: Oferece a funcionalidade de envio de e-mails para os usuários, como por exemplo, confirmação de cadastro ou redefinição de senha(para testes: https://mailtrap.io).

## Como Rodar o Projeto

Para executar o projeto, siga os passos abaixo:

1. Certifique-se de ter o Docker e o docker-compose instalados em sua máquina.

2. Clone este repositório para a sua máquina local.

3. Navegue até o diretório do projeto.

4. Crie um arquivo .env a partir do exemplo .env.example fornecido. Verifique se as configurações do banco de dados e da API externa estão corretas.
 

                Exemplo:
                DB_CONNECTION=mysql
                DB_HOST=db
                DB_PORT=3306
                DB_DATABASE=laravel
                DB_USERNAME=laravel_user
                DB_PASSWORD=123456

                MAIL_MAILER=smtp
                MAIL_HOST=sandbox.smtp.mailtrap.io
                MAIL_PORT=2525
                MAIL_USERNAME=94fdc7dc628ec5
                MAIL_PASSWORD=7d68522fd0118c
                MAIL_ENCRYPTION=null
                MAIL_FROM_ADDRESS=
                MAIL_FROM_NAME="${APP_NAME}"


5. Execute o seguinte comando para iniciar os contêineres do Docker e criar o banco de dados:


6. Aguarde até que os contêineres sejam iniciados e o projeto seja instalado.

7. Acesse o aplicativo no navegador em http://localhost:8000.

## Endpoints da API

O projeto disponibiliza os seguintes endpoints da API:

- `POST /api/login`: Endpoint para autenticação de usuários. Recebe o e-mail e a senha do usuário e retorna um token de autenticação.

- `POST /api/register`: Endpoint para registro de novos usuários. Recebe os dados do usuário (nome, e-mail e senha) e cria uma nova conta no sistema.

- `POST /api/convert-currency`: Endpoint para conversão de moedas. Recebe o valor, a moeda de origem e a moeda de destino, e retorna o valor convertido.

- `POST /api/send-email`: Endpoint para envio de e-mails. Recebe o e-mail do destinatário, o assunto e o conteúdo do e-mail, e envia a mensagem.

- `GET /api/historical-quotes`: Endpoint para obter o histórico de cotações de moedas. Retorna uma lista de todas as cotações realizadas pelos usuários.

## Considerações Finais

Este é um projeto de exemplo criado com fins educacionais para demonstrar a aplicação da Clean Architecture em um projeto PHP. Sinta-se à vontade para explorar o código-fonte e fazer melhorias ou adaptações de acordo com as suas necessidades.

Esperamos que este projeto seja útil e que possa auxiliar no seu aprendizado e prática de desenvolvimento em PHP.

Se tiver alguma dúvida ou encontrar algum problema, não hesite em nos contatar.

Divirta-se avaliando!
