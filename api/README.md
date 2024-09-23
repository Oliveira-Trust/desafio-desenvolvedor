# Instalação do Projeto #

## Requisitos: ##
Para instalar o projeto é necessário ter o php 8.2+
Composer 
Mongo DB
Uma conta no cloudamqp.com para O processo de jobs do Laravel 
Insomnia para testes com a API

### Quick Start ###

No diretório do projeto execute:
```bash

composer install 

```
Para executar o servidor:
 ```bash

 php artisan serve

 ```

 Para iniciar o worker dos Jobs, se estiver configurado corretamente as constantes no .env.example para o RabbitMQ client

 ```php
    RABBITMQ_HOST=<hostname>
    RABBITMQ_PORT=<port>
    RABBITMQ_USER=<usuario>
    RABBITMQ_PASSWORD=<password>
    RABBITMQ_QUEUE=default
    RABBITMQ_EXCHANGE_NAME=default
    RABBITMQ_EXCHANGE_TYPE=direct
    RABBITMQ_VHOST=<vhost>
 ```
#### Execução da fila #####
 ```bash
    php artisan queue:work 
 ```

 ## Documentação da API ##
 ## Rotas ##

 ```bash
 # Registro de Usuário 
 # Retorna os dados cadastrados junto com o Token
curl --request POST \
  --url http://localhost:8000/api/registro \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/10.0.0' \
  --data '{
    "email": "user3@user.com",
    "password":"ivini123",
    "password_confirmation":"ivini123",
    "name": "johnatan ívini"
}'

# Login - Retorna o usuário com um novo Token

curl --request POST \
  --url http://localhost:8000/api/login \
  --header 'Authorization: ' \
  --header 'Content-Type: application/json' \
  --header 'User-Agent: insomnia/10.0.0' \
  --data '{
    "email": "user2@user.com",
    "password":"ivini123"
}'

# Upload - Manda um arquivo de upload, o arquivo é salvo na collections Arquivo, e seu caminho salvo em banco de dados e seu conteudo salvo na collections Documentos do MongoDb.

curl --request POST \
  --url http://localhost:8000/api/arquivo/upload \
  --header 'Authorization: Bearer 66f181cece148f6eb40d1852|qESsLo3vxg83Pwgg3MD3D4jkYlxksmjBzDLVXj258709778c' \
  --header 'Content-Type: multipart/form-data' \
  --header 'User-Agent: insomnia/10.0.0' \
  --form file=@/home/ivini/Downloads/TradeInformationConsolidatedAfterHoursFile_20240920_1.csv

  #Histórico com filtro por data ou nome do arquivo com paginação

  curl --request GET \
  --url 'http://localhost:8000/api/arquivo/historico?data=2024-08-23&nome=Consolidate' \
  --header 'Authorization: Bearer 66f181cece148f6eb40d1852|qESsLo3vxg83Pwgg3MD3D4jkYlxksmjBzDLVXj258709778c' \
  --header 'Content-Type: application/x-www-form-urlencoded' \
  --header 'User-Agent: insomnia/10.0.0'

# Buscar conteúdo que foi salvo com paginação
# Precisa configurar o LIMITE DE UPLOAD E POSTSIZE no php.ini para 100M

curl --request GET \
  --url 'http://localhost:8000/api/documento/conteudo?RptDt=2024-09-20&ISIN=BRAALRACNOR6' \
  --header 'Authorization: Bearer 66f181cece148f6eb40d1852|qESsLo3vxg83Pwgg3MD3D4jkYlxksmjBzDLVXj258709778c' \
  --header 'User-Agent: insomnia/10.0.0'

  ```

  # Otimização # 

  Caso algum indice, não se comporte de maneira a retornar os dados mais rápidamente, pode criar outra migration e apontar para a coleção Documentos, a criação de novos indices, como foi feito na última migração.



