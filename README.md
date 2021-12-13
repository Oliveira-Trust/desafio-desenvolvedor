# Pré-requisitos #
* [Docker](https://docs.docker.com/get-docker/ "Docker")
* [Docker Compose](https://docs.docker.com/compose/install/ "Docker Compose")

# Iniciar aplicação #
Basta acessar **localhost** após rodar os comandos de setup da aplicação abaixo:
```shell
docker-compose down
docker-compose up -d --build
docker-compose exec app npm install
docker-compose exec app npm run prod
docker-compose exec app composer install
docker-compose exec app php artisan migrate:fresh --force
docker-compose exec app php artisan user:seed \
  --amount=1 \
  --name="Oliveira Trust"\
  --email="email@oliveiratrust.com"\
  --password="1234"
docker-compose exec app composer horizon
```
* **Caso esteja no Linux, é necessário rodar o comando com privilégios de administrador** \
* **O dotenv já está populado com algumas variáveis de ambiente core para setup facilitado**

# Credenciais de acesso #
### Aplicação ###
E-mail: email@oliveiratrust.com \
Senha: 1234

### Redis GUI ###
Usuário: root \
Senha: 1234

# Notificação por e-mail #
Para receber notificação por e-mail, basta cadastrar o SMTP desejado no dotenv da aplicação localizado em /app/src/.env

# Comandos Personalizados #
Foi criado um comando personalizado para criação de usuário via seed, porém com os dados informados ao invés de aleatórios. \
Para criar um usuário pasta rodar o comando abaixo, trocando os valores para os desejados:
```shell
docker-compose exec app php artisan user:seed \
    --amount=1 \
    --name="Oliveira Trust"\
    --email="email@oliveiratrust.com"\
    --password="1234"
```

# Serviços #
### Horizon ###
O serviço de monitoramento de jobs do Laravel pode ser acessado através do endpoint **/horizon** após o usuário já estar autenticado na aplicação

### Mongo Express ###
A GUI do MongoDB pode estar sendo acessada em **http://localhost:8081**

### Redis Commander ###
A GUI do Redis pode estar sendo acessada em **http://localhost:8090**