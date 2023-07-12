## Projeto Laravel - Desafio Desenvolvedor
Este é o projeto Laravel para o Desafio Desenvolvedor, onde foram utilizadas as tecnologias PHP, Laravel, HTML, CSS e JavaScript.

## Estrutura do Projeto
O projeto foi organizado seguindo as boas práticas e padrões adotados no PHP e no Laravel. Foi implementada uma estrutura com as camadas Repository e Service, buscando separar as responsabilidades e facilitar a manutenção do código, atendendo os princípios SOLID, mais especificamente o princípio da Responsabilidade Única (Single Responsibility Principle - SRP) e o princípio da Inversão de Dependência (Dependency Inversion Principle - DIP).

## Funcionalidades
O projeto implementa as seguintes funcionalidades:

Autenticação: A autenticação foi gerada automaticamente utilizando o Laravel Breeze, proporcionando uma autenticação simples e segura.

Conversão de Moedas: O sistema permite realizar a conversão de moedas, utilizando uma API externa para obter os dados de conversão. As conversões são registradas e associadas ao usuário que as realizou.

Taxas de Pagamento: O sistema permite registrar e gerenciar as taxas de pagamento, definindo taxas diferentes para diferentes tipos de pagamento.

## Documentação das APIs
As APIs implementadas no projeto foram devidamente documentadas seguindo as boas práticas. A documentação das APIs inclui informações sobre os endpoints, os parâmetros esperados, as respostas retornadas e possíveis erros.

## Seeds e Factories
Foram criados seeders para popular o banco de dados com as taxas de pagamento iniciais e um factory para criar automaticamente dados de conversão de moedas para fins de teste.

## Migrations e Comentários
As migrations utilizadas para criar as tabelas no banco de dados foram criadas com comentários, fornecendo informações sobre os campos e suas finalidades.

## Relacionamento entre Modelos
Foi estabelecido um relacionamento entre o modelo User e o modelo CurrencyConversion, permitindo associar as conversões de moedas aos usuários correspondentes.

## Integração com API Externa
Para acessar os dados de conversão de moedas, foi utilizada a biblioteca HTTP do Laravel. No entanto, uma alternativa seria utilizar a biblioteca Guzzle para fazer requisições HTTP à API externa.

## Envio de E-mails
Após a realização de uma conversão de moedas, é disparado um Job que envia um e-mail ao usuário informando sobre a conversão. Esse Job é acionado quando um registro é criado no modelo CurrencyConversion, através do observer CurrencyConversionObserver.

## Listagem das Conversões
Foi implementada uma funcionalidade que permite listar as conversões de moedas realizadas por um usuário. É possível configurar o número de registros exibidos por página e a ordenação dos resultados.

## Implementações Futuras
Algumas implementações que podem ser realizadas posteriormente incluem:

Implementação do Circuit Breaker para lidar com possíveis falhas ou problemas de desempenho da API externa.

Testes Mock que utilizem o Redis como banco de memória para realizar testes unitários e de integração.

## Configuração do Projeto
Para configurar e executar o projeto, siga as instruções abaixo:

Clone o repositório para o seu ambiente local.

Instale as dependências do projeto executando o comando composer install no diretório do projeto.

Crie um arquivo .env na raiz do projeto e defina as configurações do banco de dados, bem como outras configurações necessárias.

Execute as migrations para criar as tabelas do banco de dados com o comando php artisan migrate.

Execute as seeders para popular o banco de dados com as taxas de pagamento iniciais usando o comando php artisan db:seed --class=ConversionFeesSeeder e php artisan db:seed --class=PaymentFeesSeeder.

Inicie o servidor local do Laravel executando o comando php artisan serve.

Acesse a aplicação em seu navegador utilizando a URL fornecida pelo servidor local.

## Conclusão
Este projeto Laravel para o Desafio Desenvolvedor implementa as funcionalidades solicitadas seguindo boas práticas de desenvolvimento e utilizando tecnologias relevantes. 