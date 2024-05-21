## Currency Conversion Application

A Currency Conversion Application foi criada para fornecer uma solução simples e eficiente para a conversão da moeda nacional (BRL) em diversas moedas estrangeiras, aplicando as taxas e regras necessárias. Com esta aplicação, os usuários podem converter valores em BRL para outras moedas, obtendo informações detalhadas sobre a conversão, incluindo as taxas aplicadas e o valor final na moeda estrangeira.

### Principais Características e Funcionalidades

#### Conversão de Moedas

Os usuários podem converter valores em BRL para várias moedas estrangeiras. A aplicação utiliza a API AwesomeAPI para obter taxas de conversão atualizadas em tempo real.

#### Seleção de Moeda de Destino

Os usuários podem escolher entre várias opções de moedas estrangeiras para a conversão. A aplicação oferece suporte para a conversão do BRL para diversas moedas, proporcionando flexibilidade para atender às necessidades de diferentes usuários.

#### Entrada de Valor para Conversão

O valor a ser convertido deve ser inserido pelo usuário e deve estar entre R$ 1.000,00 e R$ 100.000,00.

#### Formas de Pagamento

Os usuários podem selecionar entre duas formas de pagamento, cada uma com sua própria taxa:

-   Boleto: 1,45% de taxa
-   Cartão de Crédito: 7,63% de taxa

#### Taxa de Conversão Adicional

Uma taxa de conversão adicional é aplicada com base no valor de entrada:

-   2% para valores abaixo de R$ 3.000,00
-   1% para valores iguais ou superiores a R$ 3.000,00

#### Detalhamento da Conversão

A aplicação fornece um detalhamento completo da conversão, incluindo:

-   Valor da moeda estrangeira usada para a conversão
-   Quantidade comprada na moeda de destino
-   Taxa de pagamento
-   Taxa de conversão
-   Valor total utilizado para a conversão após a dedução das taxas

#### Exemplo de Funcionamento

##### Parâmetros de Entrada

-   Moeda de origem: BRL (default)
-   Moeda de destino: USD
-   Valor para conversão: R$ 5.000,00
-   Forma de pagamento: Boleto

##### Parâmetros de Saída

-   Moeda de origem: BRL
-   Moeda de destino: USD
-   Valor para conversão: R$ 5.000,00
-   Forma de pagamento: Boleto
-   Valor da "Moeda de destino" usado para conversão: $ 5,30
-   Valor comprado em "Moeda de destino": $ 920,18
-   Taxa de pagamento: R$ 72,50
-   Taxa de conversão: R$ 50,00
-   Valor utilizado para conversão descontando as taxas: R$ 4.877,50

#### Envio de Cotação por E-mail

A aplicação pode enviar detalhes da conversão realizada para o e-mail do usuário.

#### Autenticação de Usuário

Segurança de acesso com autenticação de usuário.

#### Histórico de Cotações

Armazenamento e exibição do histórico de cotações realizadas pelo usuário.

#### Edição de taxas

Em configurações ou Settings é possivel editar as taxas incidentes sobre as conversões de moedas.

![Settings](https://imgur.com/gZJKCfH.jpeg)

#### Instalação e Configuração

A seguir, serão apresentadas as instruções para instalação e configuração da Currency Conversion Application, juntamente com exemplos de uso de suas principais funcionalidades. O projeto é construído utilizando o framework Laravel, aproveitando suas poderosas funcionalidades para uma experiência de usuário eficiente e segura.

Siga as instruções detalhadas para começar a usar a aplicação e realizar suas conversões de moeda de forma rápida e confiável.

###### Pré-requisitos

-   Docker
-   Docker Compose

#### Instalação

1. Clone o repositório para sua máquina local:

```
git clone <repositrio-do-projeto>
```

2. Navegue até o diretório raiz do projeto:

```
cd <diretorio-do-projeto>
```

3. Instale as dependencias:

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

4. Inicie os containers Docker:

`./vendor/bin/sail up -d`

5. Crie o arquivo .env:

`cp .env.example .env`

6. Gere as chaves de segurança da aplicação:

`sail artisan key:generate`

7. Execute as migrações:

`./vendor/bin/sail artisan migrate`

6. Popule o banco de dados com contatos:

`./vendor/bin/sail artisan db:seed`

Em seguida:

`sail artisan currencies:import`

Para importar a lista de nomes das moedas con seus respectivos códigos e a lista de conversões possíveis.

7. Instale as dependências do front-end para visualizar o relatório:

`sail npm install`

8. Inicie o a aplicação node.

`sail npm run dev`

9. Para que os e-mails sejam enviados execute o comando:
   `sail artisan queue:work`

10. Acesse a URL http://localhost/login

    ![Dashboard](https://imgur.com/ncZZSVX.jpeg)

#### Operação

1. No menu de navegação acesse ao item 'Cotações'.
   Será carregada a página com o hitórioco de cotações já realizadas pelo usuário.
2. No canto superior direito do painel do histórico, clique no botão 'Nova cotação'. O usuário será direcionado para a página de cotação.
   ![Cotações](https://imgur.com/oL3QbLo.jpeg)
3. Na página de Criar cotação os campos de entrada ficam no painel de Conversão, onde o usuário pode selecinar qual moeda será convertida o Real Brasileiro, o valor para conversão e, por ultimo, a forma de pagamento.
   ![Cotações](https://imgur.com/sp92A7c.jpeg)
4. Após informar os dados de entrada, clique no botão 'Calcular' para os dados de Cotação sejam carregados no painel de Cotação.
5. Para realizar a compra da moeda convertida clique no botão 'Comprar'.
   ![Cotações](https://imgur.com/UqzKhTo.jpeg)
6. Após a realização da compra o usuário será direcinado para a págian de Detalhes da cotação e tambão será encaminhado para o endereço de e-mail do usuário a cotação realizada.
   ![Cotações](https://imgur.com/nmgi6Gn.jpeg)

###### Implementações futuras

-   Cadastro dinâmico de taxas.

###### Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue ou enviar um pull request.

###### Licença

Este projeto está licenciado sob a MIT License.
