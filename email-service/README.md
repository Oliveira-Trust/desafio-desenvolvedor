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


## 💻 Projeto

Esse projeto é uma uma aplicação que faz a conversão da nossa moeda nacional para uma moeda estrangeira, 
aplicando algumas taxas e regras, apresentando no final da conversão o resultado detalhado.

Foi feita a integração com a API pública [AwesomeAPI](https://docs.awesomeapi.com.br/api-de-moedas),
que entrega cotações de verdade e atuais.

## Microserviço para Envio de Emails  
Este microserviço é responsável por enviar todos os emails da aplicação para os destinatários.  
Para escalar este serviço basta criar novos containers Workers para processar a fila de emails mais rapidamente.

## ⚙️ Instalação e execução
Após ter clonado o repositório, acessar a pasta `email-service` e digitar o comando abaixo.  
Todas as dependências serão instaladas automaticamente durante a criação dos containers.
```sh
docker-compose up -d
```

## Enviando Emails
Para que este serviço possa enviar emails será necessário configurar uma conta de email válida.
Os testes locais foram feitos utilizando o servidor de email do Gmail.  

Altere o arquivo `docker-compose.yaml` na raiz do projeto com os parâmetros corretos.  
Essas configurações devem ser feitas nas linhas **22 a 27** e nas linhas **66 a 71**  
```sh
_MAIL_DRIVER=
_MAIL_HOST=
_MAIL_PORT=
_MAIL_USERNAME=
_MAIL_PASSWORD=
_MAIL_ENCRYPTION=
```  

Desenvolvido por Thiago Luna: [Linkedin!](https://www.linkedin.com/in/thiago-luna/)


