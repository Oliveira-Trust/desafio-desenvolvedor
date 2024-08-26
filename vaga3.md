<p>
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQIAOtqQ5is5vwbcEn0ZahZfMxz1QIeAYtFfnLdkCXu1sqAGbnX" width="300">
 </p>
 
## Desafio para candidatos à vaga de Desenvolvedor PHP (Jr/Pleno/Sênior).
Olá caro desenvolvedor, nosso principal objetivo é conseguir ver a lógica implementada independente da sua experiência, framework ou linguagem utilizada para resolver o desafio. Queremos avaliar a sua capacidade em aplicar as regras de négocios na aplicação, separar as responsabilidades e ter um código legível para outros desenvolvedores, as instruções nesse projeto são apenas um direcional para entregar o desafio mas pode ficar livre para resolver da forma que achar mais eficiente. 🚀 

Não deixe de enviar o seu teste mesmo que incompleto!

## Tecnologias a serem utilizadas
* PHP (Framework Laravel preferencialmente)

## Entrega:
Para iniciar o teste, faça um fork deste repositório, **crie uma branch com o seu nome completo** e depois envie-nos o pull request. Se você apenas clonar o repositório não vai conseguir fazer push e depois vai ser mais complicado fazer o pull request.

Fique a vontade para enviar o seu LinkedIn ou currículo para vagas@oliveiratrust.com.br. 

## O que vamos avaliar:
- Legibilidade do código
- Modularização
- Lógica para aplicar a regra de négocio
- Utilização da API
- Documentação da API

## O que NÃO vamos avaliar:
- Interface visual

## Instruções para o desafio:
O objetivo do desafio é avaliar a lógica do candidato, bem como organização do código e estrutura de programação.

Vamos levar em consideração a utilização das funções/helpers do framework (caso utilize) para resolver o desafio, assim poderemos avaliar o quanto você conhece do framework(caso utilize).

Faça o máximo de commits possíveis para ajudar na evolução da entrega, assim podemos estimar como você se organiza para entregar um objetivo.

Não se esqueça de criar a branch com o seu nome completo e enviar um email, nesse email fique a vontade para enviar Informações complementares como linkedin, página do github ou qualquer informação complementar.

Você vai encontrar um arquivo de exemplo em: [Baixar arquivo](https://github.com/Oliveira-Trust/desafio-desenvolvedor/blob/master/InstrumentsConsolidatedFile_20240823.csv)

## O Desafio:
A API precisa ter no mínimo 3 endpoints, com as seguintes funcionalidades:
- Upload de arquivo
- Histórico de upload de arquivo
- Visualizar conteúdo do arquivo

### As Regras de négocio:
- Upload de arquivo:
  - Deve ser possível enviar arquivos no formato Excel e CSV
  - Não é permitido enviar o mesmo arquivo 2x
- Histórico de upload de arquivo:
  - Deve ser possível buscar um envio especifico por nome do arquivo ou data referência
- Buscar conteúdo do arquivo:
  - Neste endpoint deve ser obrigatório o envio de no minimo 2 informações os campos TckrSymb e RptDt.
  - O retorno esperado deve conter no mínimo essas informações:
  ``` 
  {
    "RptDt": "2024-08-22",
    "TckrSymb": "AMZO34",
    "MktNm": "EQUITY-CASH",
    "SctyCtgyNm": "BDR",
    "ISIN": "BRAMZOBDR002",
    "CrpnNm": "AMAZON.COM, INC"
    }
    ```

### Exemplo de funcionamento:

#### Parâmetros de entrada:
- TckrSymb: AMZO34
- RptDt: 2024-08-26

#### Parâmetros de saída:
  ``` 
  {
    "RptDt": "2024-08-22",
    "TckrSymb": "AMZO34",
    "MktNm": "EQUITY-CASH",
    "SctyCtgyNm": "BDR",
    "ISIN": "BRAMZOBDR002",
    "CrpnNm": "AMAZON.COM, INC"
    }
  ```

### Bônus:
* Utilizar banco de dados NOSQL para armazenar os dados do upload
* Utilização de cache
* Utilização de autenticação para consumir os endpoints

## Informações úteis para o desenvolviment da api:
Você pode encontrar os arquivos para testar em:

URL: https://www.b3.com.br/pt_br/market-data-e-indices/servicos-de-dados/market-data/consultas/boletim-diario/dados-publicos-de-produtos-listados-e-de-balcao/

Descrição: Clique em uma data, cliquei em "Cadastro de Instrumentos (Listado)" e clique em "Baixar arquivo"


### Boa sorte! 🚀

## Apêndice

Coloque qualquer informação adicional aqui

