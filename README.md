# Currency Exchange System
Este é um sistema de exchange de moedas desenvolvido em Laravel. Ele permite que os usuários realizem conversões de moedas baseadas nas taxas de câmbio fornecidas pela API AwesomeAPI.

## Funcionalidades
- Registro e autenticação de usuários.
- Conversão de moedas com base nas taxas de câmbio em tempo real.
- Visualização de transações anteriores.
- Aplicação de taxas de conversão e métodos de pagamento. 

## Requisitos
- Docker
- Docker Compose


### Instalação
1. Clone o repositório para o seu ambiente local:

``` bash
git clone https://github.com/PauloRicardoNeis/desafio-desenvolvedor.git
```

2. Renomeie o arquivo .env-example para .env:

``` bash
mv .env-example .env
```

3. Configure as variáveis de ambiente no arquivo .env de acordo com o seu ambiente, especialmente as configurações do banco de dados.

4. Execute o Docker Compose para construir e iniciar os contêineres:

``` bash
docker-compose up --build
```

5. Execute as migrações do banco de dados:

``` bash
docker-compose exec app php artisan migrate
```
6. Popule o banco de dados com dados fictícios:

``` bash
docker-compose exec app php artisan db:seed
```
7. Acesse o sistema em http://localhost:8080.

8. Registre-se no sistema através da interface web.

