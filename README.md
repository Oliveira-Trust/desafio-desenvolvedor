<h2 align="center">
    <img src="https://avatars.githubusercontent.com/u/58981329?s=200&v=4" alt="Oliveira Trust" width="24" /> Desafio Desenvolvedor
</h2>

## 🚀 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- [PHP 7.4](https://php.net)
- [Laravel 8](https://laravel.com)
- [MySQL 5.7](https://mysql.com)
- [Docker](https://docker.com)
- [Redis](https://redis.io)
- [RabbitMQ](https://www.rabbitmq.com/)


## 📑 Projeto

Esse projeto é uma uma aplicação que faz a conversão da nossa moeda nacional para uma moeda estrangeira,
aplicando algumas taxas e regras, apresentando no final da conversão o resultado detalhado.  
Permite gereciar Taxas, Moedas e Meios de Pagamento, além de disponibilizar histórico das cotações por usário logado 
e histórico geral de todos os usuários para usuário com perfil de administrador e buscas por filtros.

Foi feita a integração com a API pública [AwesomeAPI](https://docs.awesomeapi.com.br/api-de-moedas),
que entrega cotações de verdade e atuais.

## ⚙️ Instalação e execução

## 1- Clonar o Projeto e Criar Rede Externa do Docker
Clonar este repositório, acessar a pasta do projeto e executar o comando abaixo:  
```sh
docker network create oliveira-trust
```  

## 2- Microserviço De Mensageria com RabbitMQ
Este microserviço é responsável por gerenciar as filas da aplicação para troca de mensagens entre os microserviços.  
Após ter clonado o repositório, **e ter criado a rede externa**, acessar a pasta `rabbitmq-service` e digitar o comando abaixo.
```sh
docker-compose up -d
```  
Para acessar o dashboard do RabbitMQ abra algum navegador e digite a url `http://localhost:15672`  
Login = Senha = guest  


## 3- Microserviço Principal - Autenticação de Usuário e Cotação de Valores
Este microserviço é responsável por autenticar o usuário, realizar a cotação solicitada pelo usuário e fornecer
histórico das cotações.  
Permite ao usuário com perfil de administrador gerenciar o CRUD de Taxas, Moedas e Meios de Pagamento, além de
visualizar o histórico geral de cotações de todos os usuários e fazer buscas no histórico através de filtros.

Após ter clonado o repositório e ter executado os passos 1 e 2 descritos acima, acessar a pasta `main-service` e digitar o comando abaixo.  
Todas as dependências serão instaladas automaticamente durante a criação dos containers.
```sh
docker-compose up -d
```
**OBS.:** A rede externa do docker já deverá ter sido criada.  


## 4- Microserviço para Envio de Emails
Este microserviço é responsável por enviar todos os emails da aplicação para os destinatários.  
Para escalar este serviço basta criar novos containers Workers para processar a fila de emails mais rapidamente.

- **Enviando Emails**  
Para que este serviço possa enviar emails será necessário configurar uma conta válida de servidor de emails.  
Os testes locais foram feitos utilizando o servidor de email do Gmail.

Acessar a pasta `email-service` e alterar o arquivo `docker-compose.yaml` com os parâmetros corretos.  
Essas configurações devem ser feitas nas linhas **22 a 27** e nas linhas **66 a 71**
```sh
_MAIL_DRIVER=
_MAIL_HOST=
_MAIL_PORT=
_MAIL_USERNAME=
_MAIL_PASSWORD=
_MAIL_ENCRYPTION=
```  

Após ter feito as configurações do servidor de email e ter executado os passos 1, 2 e 3 descritos acima, na pasta `email-service` 
digitar o comando abaixo.  
Todas as dependências serão instaladas automaticamente durante a criação dos containers.
```sh
docker-compose up -d
```
**OBS.:** Os microserviços são independentes. Caso o microserviço de envio de email não esteja configurado com um 
servidor de email, mesmo assim o microserviço principal funcionará normalmente, permitindo o usuário se logar e fazer 
as cotações. Somente não terá a cotação enviada para o seu email.  

## 💻 Acessar o Sistema
Abrir algum browser e acessar a url `http://localhost:8000`.
- Usuário Admin - Acesso a todas as funcinalidades do sistema.  
  Login: admin@email.com  
  Senha: secret

- Usuário comun  
  Login: user@email.com  
  Senha: secret

**OBS.:** para que o email seja enviado, será necessário cadastrar um novo usuário com um email válido e
ter configurado o microserviço de envio de email corretamente.  

## 🚀 Funcionalidades do Laravel usadas nesta aplicação
- Migrations, Factories, Seeders, Mutators, Cache, Jobs, Mails, Helpers.
- Para melhorar a performance da API, os resultados das requisições de cotação à API externa ficam em Cache no Redis.
- Conforme requisitos a API, originalmente, faz conversão entre 2 moedas específicas.
- Para tal, executando `docker-compose up -d` pela primeira vez, o `docker-compose.yml` irá executar` php artisan migrate --seed`
  que criará a tabela Currencies no banco de dados já com as moedas USD, EUR e CAD.

## Base de dados
- MySQL
- Eloquent ORM para trabalhar com uma base de dados, onde as tabelas têm um "Modelo" correspondente que se utiliza para interagir com essa tabela.

## Design Pattern
- **Repository Design Pattern** para separar o acesso aos dados (Repositories) da lógica de negócios (Service Layers).  
  Com este padrão temos uma divisão de responsabilidades, deixando cada camada da aplicação o mais simples possível, 
  contribuindo para a aplicação ser escalável mais facilmente.  
- **Strategy** para organizar e separar o uso de um HttpClient para consumir uma API externa, padronizando a usabilidade
  das classes, de forma que novas implementações possam ser adicionadas no futuro.   
  Neste projeto, o Curl está sendo usado, mas, caso haja necessidade de utilizar o Guzzle, basta apenas criar uma nova 
  classe que implemente a interface com o método utilizando o Guzzle e alterar o bind feito entre a interface HttpClient e a nova classe.

**PS.:** Também foi utilizado neste projeto os princípios do SOLID e DRY.  

## 🎯 ️Testes Automatizados
Os testes cobrem os CRUDs de Taxas, Moedas, Meios de Pagamento, Users, métodos dos Service Layers e requisições de cotação.  
Ex.:  
- Teste de cotação para USD com valor inferior a R$ 1.000,00.  
- Teste de cotação para USD com valor superior a R$ 100.000,00.  
- Teste de cotação para USD com valor inferior a R$ 3.000,00 e pagamento por Boleto Bancário.  
- Teste de cotação para USD com valor superior a R$ 3.000,00 e pagamento por Boleto Bancário.  
- Teste de cotação para USD com valor inferior a R$ 3.000,00 e pagamento por Cartão de Crédito.  
- Teste de cotação para USD com valor superior a R$ 3.000,00 e pagamento por Cartão de Crétido.  

Para executar os testes, execute un dos comandos abaixo dentro da pasta `main-service`   
```sh
docker-compose exec app vendor/bin/phpunit
docker-compose exec app php artisan test
```

## 🔨 Testes de Estresse
Foi utilizada a ferramenta [jmeter](http://jmeter.apache.org/download_jmeter.cgi) para testes de estresse tanto
desta aplicação quanto da API externa para consulta das cotações.

Desenvolvido por Thiago Luna: [Linkedin!](https://www.linkedin.com/in/thiago-luna/)