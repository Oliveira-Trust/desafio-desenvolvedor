<p>
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQIAOtqQ5is5vwbcEn0ZahZfMxz1QIeAYtFfnLdkCXu1sqAGbnX" width="300">
 </p>
 
## Desafio para candidatos à vaga de Desenvolvedor (Jr/Pleno/Sênior).
Olá caro desenvolvedor, nosso principal objetivo é conseguir ver a lógica implementada independente da sua experiência, framework ou linguagem utilizada para resolver o desafio. Queremos avaliar a sua capacidade em aplicar as regras de négocios na aplicação, separar as responsabilidades e ter um código legível para outros desenvolvedores, as instruções nesse projeto são apenas um direcional para entregar o desafio mas pode ficar livre para resolver da forma que achar mais eficiente. 🚀 

Não deixe de enviar o seu teste mesmo que incompleto!

## Tecnologias a serem utilizadas
* PHP (Framework Laravel preferencialmente)
* Python

## Entrega:
Para iniciar o teste, faça um fork deste repositório, **crie uma branch com o seu nome completo** e depois envie-nos o pull request. Se você apenas clonar o repositório não vai conseguir fazer push e depois vai ser mais complicado fazer o pull request.

Fique a vontade para enviar o seu LinkedIn e o link do seu pull request para vagas@oliveiratrust.com.br.

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

Para o primeiro upload preparamos um arquivo de aproximadamente 400.000 linhas: [Baixar arquivo](https://github.com/Oliveira-Trust/desafio-desenvolvedor/blob/master/InstrumentsConsolidatedFile_20240822_20240827.zip), neste arquivo temos informações de várias datas unificadas em um mesmo arquivo.

Para realizar o seu desafio imagine que diariamente receberemos um arquivo de aproximadamente 75.000 linhas isso pode influenciar na sua lógica.

## O Desafio:
A API precisa ter no mínimo 3 endpoints, com as seguintes funcionalidades:
- Upload de arquivo
- Histórico de upload de arquivo
- Buscar conteúdo do arquivo

### As Regras de négocio:
- Upload de arquivo:
  - Deve ser possível enviar arquivos no formato Excel e CSV
  - Não é permitido enviar o mesmo arquivo 2x
- Histórico de upload de arquivo:
  - Deve ser possível buscar um envio especifico por nome do arquivo ou data referência
- Buscar conteúdo do arquivo:
  - Neste endpoint é opcional o envio de parâmetros mas deve ser possível enviar no mínimo 2 informações para busca, que seriam os campos TckrSymb e RptDt.
  - Se não enviar nenhum parâmetro o resultado deve ser apresentado páginado.
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
* Utilização de Cache
* Utilização de autenticação para consumir os endpoints
* Utilização de Filas
* Utilização de Container
  
Obs.: Nenhum dos pontos citados é obrigatório na entrega, embora ele possa ser positivo, se mal implementado pode ser pior do que entregar uma solução mais simples e de maior qualidade.

## Informações úteis para o desenvolvimento da api:
Você pode encontrar os arquivos para testar na URL abaixo, nela você vai encontrar um arquivo com uma quantidade aproximada de 75.000 linhas.

URL: https://www.b3.com.br/pt_br/market-data-e-indices/servicos-de-dados/market-data/consultas/boletim-diario/dados-publicos-de-produtos-listados-e-de-balcao/

Descrição: Clique em uma data, clique em "Cadastro de Instrumentos (Listado)" e clique em "Baixar arquivo"

### Boa sorte! 🚀

