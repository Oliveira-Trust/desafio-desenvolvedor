<h1 align="center">
    Desafio: Conversor de Moedas
</h1>

## Índice

-   <a href="#boat-sobre-o-projeto">Sobre o projeto</a>
-   <a href="#hammer-tecnologias">Tecnologias</a>
-   <a href="#clipboard-pré-requisitos">Pré-requisitos</a>
-   <a href="#rocket-como-rodar-esse-projeto">Como rodar esse projeto</a>
-   <a href="#gear-principais-características-e-funcionalidades">Principais Características e Funcionalidades</a>
    -   <a href="#conversão-de-moedas">Conversão de Moedas</a>
    -   <a href="#seleção-de-moeda-de-destino">Seleção de Moeda de Destino</a>
    -   <a href="#entrada-de-valor-para-conversão">Entrada de Valor para Conversão</a>
    -   <a href="#formas-de-pagamento">Formas de Pagamento</a>
    -   <a href="#taxa-de-conversão-adicional">Taxa de Conversão Adicional</a>
    -   <a href="#envio-de-cotação-por-e-mail">Envio de Cotação por E-mail</a>
    -   <a href="#histórico-de-cotações">Histórico de Cotações</a>
    -   <a href="#edição-de-taxas">Edição de taxas</a>
-   <a href="#bookmark_tabs-licença">Licença</a>
-   <a href="#wink-autores">Autores</a>

## :boat: Sobre o projeto

Este projeto é uma aplicação web que facilita a conversão da moeda nacional (BRL) para várias moedas estrangeiras. Utilizando a API de Moedas do AwesomeAPI, a aplicação permite que os usuários insiram um valor em BRL e escolham uma moeda de destino para realizar a conversão, aplicando taxas específicas conforme a forma de pagamento selecionada.

## :hammer: Tecnologias:

-   **[PHP](https://www.typescriptlang.org)**
-   **[JavaScript](https://www.javascript.com/)**
-   **[Laravel](https://nestjs.com/)**
-   **[PostgreSQL](https://www.postgresql.org/)**
-   **[Docker](https://www.postgresql.org/)**
-   **[Sail](https://jestjs.io/pt-BR/)**
-   **[Blade](https://jestjs.io/pt-BR/)**
-   **[Alpine.js](https://alpinejs.dev/)**
-   **[Tailwind CSS](https://tailwindcss.com/)**

## :clipboard: Pré-requisitos

-   Docker
-   Docker Compose
-   NodeJs
-   Gerenciador de pacotes Node

## :rocket: Como rodar esse projeto

Se você estiver usando Windows, vai precisar do WSL para rodar esse projeto de forma prática. Para isso, você pode instalá-lo seguindo o seguinte [tutorial](https://learn.microsoft.com/pt-br/windows/wsl/install). Também será necessário uma distribuição linux para utilizar o WSL. Recomendo o Ubuntu que pode ser baixando na própria Microsoft Store no [link](https://apps.microsoft.com/store/detail/ubuntu/9PDXGNCFSCZV).
Depois, vai precisar do Docker, o qual a versão de Windows pode ser encontrada [aqui](https://docs.docker.com/desktop/install/windows-install/).
Então, clone o projeto dentro do WSL, vá para pasta dele e execute o comando para instalar as dependências:

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

Após a instalação, basta executar o comando:

```
docker compose up-d
```

Agora precisamos configurar as variáveis ambientes. Crie o arquivo .env:

```
cp .env.example .env
```

Crie as chaves de segurança da aplicação:

    `sail artisan key:generate`

Execute as migrações:

    `./vendor/bin/sail artisan migrate`

Popule o banco de dados com contatos:

    `./vendor/bin/sail artisan db:seed`

Para importar a lista de nomes das moedas con seus respectivos códigos e a lista de conversões possíveis.

    `sail artisan currencies:import`

Instale as dependências do front-end para visualizar o relatório:

    `sail npm install`

Inicie o a aplicação node.

    `sail npm run dev`

Para que os e-mails sejam enviados execute o comando:

    `sail artisan queue:work`

O projeto estará executando no endereço http://localhost.

![Dashboard](https://imgur.com/ncZZSVX.jpeg)

## :gear: Principais Características e Funcionalidades

#### Conversão de Moedas

Os usuários podem converter valores em BRL para várias moedas estrangeiras. A aplicação utiliza a API AwesomeAPI para obter taxas de conversão atualizadas em tempo real.

![Cotações](https://imgur.com/sp92A7c.jpeg)

#### Seleção de Moeda de Destino

Os usuários podem escolher entre várias opções de moedas estrangeiras para a conversão. A aplicação oferece suporte para a conversão do BRL para diversas moedas, proporcionando flexibilidade para atender às necessidades de diferentes usuários.

![Cotações](https://imgur.com/XcPPfSL.jpeg)

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

#### Envio de Cotação por E-mail

A aplicação pode enviar detalhes da conversão realizada para o e-mail do usuário.

### Detalhamento da Conversão

Após informar os dados para conversão, ao clicar o botão "Calcular" será consumida a url responsável por executar a ação no controloador responsável pelas requisições de Cotação.

```
    axios.post('/quotes/calc', data)
         .then(function(response) {
            quoteCalcResult(response.data);
            var buyButton = document.getElementById('buyButton');
            buyButton.disabled = false;
        })
        .catch(function(error) {
            console.log(error);
        }).finally(function() {
            document.getElementById('spinner').style.display = 'none';
        });
```

No controlador das cotaçaões é executo uma consulta atraves um serviço na api de cotação de moedas com a moeda selecionada para obter a cotação do momento.

```
class Quotes extends BaseEndpoint{
    public function currency(string $currency)
    {
        $jsonString = $this->service->api->get($this->path . "/{$currency}");
        return json_decode($jsonString, true);
    }
}
```

Após a obtenção da cotação é realiza a contrução da cotação.

```
public function calc(CalcConversionQuoteRequest $request)
    {
        try {
            $conversion = $request->validated();
            $quoteData = $this->service->quotes()->currency($conversion["currency"])[0];
            $quoteBuilder = new QuoteBuilder($this->feeRules);
            $quote = $quoteBuilder
                ->setConversionAmount($conversion['amount'])
                ->setName($quoteData['name'])
                ->setCurrencyOrigin($quoteData['codein'])
                ->setCurrencyName($quoteData['code'])
                ->setPaymentMethod($conversion['payment_method'])
                ->setFee($conversion['fee'])
                ->setCurrencyValue($quoteData['bid'])
                ->calculateFees()
                ->build();
            return $quote;
        } catch (\Throwable $th) {
            return response("Error", 500);
        }
    }
```

Os calculos são realizados pelo Builder de Cotação.

```
public function calculateFees()
    {
        $this->quote->conversion_fee = $this->feeRules->getConversionFee($this->quote->conversion_amount);
        $this->quote->payment_rate = $this->quote->conversion_amount * $this->quote->fee;
        $this->quote->conversion_rate = $this->quote->conversion_amount * $this->quote->conversion_fee;
        $this->quote->conversion_value = $this->quote->conversion_amount - $this->quote->payment_rate - $this->quote->conversion_rate;
        $this->quote->converted_amount = $this->quote->conversion_value / $this->quote->currency_value;
        return $this;
    }
```

#### Autenticação de Usuário

Segurança de acesso com autenticação de usuário.

![Cotações](https://imgur.com/emhNvIK.jpeg)

#### Histórico de Cotações

Armazenamento e exibição do histórico de cotações realizadas pelo usuário.

![Cotações](https://imgur.com/oL3QbLo.jpeg)

#### Edição de taxas

Em configurações ou Settings é possivel editar as taxas incidentes sobre as conversões de moedas.

![Settings](https://imgur.com/gZJKCfH.jpeg)

## :handshake: Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue ou enviar um pull request.

## :bookmark_tabs: Licença

Este projeto esta sobe a licença MIT. Veja a [LICENÇA](https://opensource.org/licenses/MIT) para saber mais.

## :wink: Autores

Feito com ❤️ por:

-   [Ederson Ribeiro Silva](https://www.linkedin.com/in/edRibeiro/)

[Voltar ao topo](#índice)
