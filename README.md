# Desafio Oliveira Trust
Desenvolvido por Newton Gonzaga Costa

## Execução (O que foi feito)
- ~~CRUD de clientes~~.
- ~~CRUD de produtos~~.
- ~~CRUD de pedidos de compra, com status (Em Aberto, Pago ou Cancelado)~~.
    - Cada CRUD:
        - ~~deve ser filtrável e ordenável por qualquer campo~~.
        - ~~deve possuir formulários para criação e atualização de seus itens~~.
        - ~~deve permitir a deleção de qualquer item de sua lista~~.
        - ~~Barra de navegação entre os CRUDs~~.
        - ~~Links para os outros CRUDs nas listagens (Ex: link para o detalhe do cliente da compra na lista de pedidos de compra)~~

# Instruções Gerais
Projeto desenvolvido com tecnologia DevOps com auxílio da ferramenta docker que faz com o desenvolverdor fique focado na sua aplicação e não na infraestrutura necessária pra que sua aplicação funcione.

Para rodar o projeto existem duas opções ter o docker instalado o que facilita imensamente o teste do projeto ou colocar a pasta api e a pasta dist do angular dentro de um webserver.

## Docker
1. API
    1. Se tivermos o docker, basta executar o comando ```./init.sh -u ``` para iniciar o servidor da api no terminal/prompt.
    2. Precisamos criar um banco com charset utf8mb4 e com collation utf8mb4_general_ci através de qualquer ferramenta a sua escolha, aqui eu utilizei o DBeaver.
    3. Executar o comando ```./init.sh -a``` para acessar o container da aplicação no terminal/prompt.
    4. Renomear o arquivo .env.example para .env
    5. Executar o comando php artisan migrate no terminal/prompt.
    6. Executar o comando php artisan db:seed no terminal/prompt.
2. Frontend
    1. Em outro terminal acesse a pasta gui dentro de desafio-desenvolvedor
    2. Execute o comando ```npm start```.

## WebServer
1. Banco
    1. Precisamos criar um banco com charset utf8mb4 e com collation utf8mb4_general_ci através de qualquer ferramenta a sua escolha, aqui eu utilizei o DBeaver.
2. API
    1. Copiar a pasta api para dentro da pasta onde o webserver estará observando.
    2. Acessar a pasta api dentro de desafio-desenvolvedor
    3. Renomear o arquivo .env.example para .env
    4. Executar o comando php artisan migrate no terminal/prompt
    5. Executar o comando php artisan db:seed no terminal/prompt
2. Frontend
    1. Em outro terminal acesse a pasta gui dentro de desafio-desenvolvedor
    2. Execute o comando ```npm start```


