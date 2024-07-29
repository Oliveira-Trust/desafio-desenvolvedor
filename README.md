# Projeto Converter

Aplicacao para conversao de moeda

Link para acessar o projeto: http://216.238.119.59/

## Como rodar o projeto

### Requisitos:
- docker

### Instalação:
1 - clone o projeto na sua maquina:

    git clone https://github.com/VictordaSilvaf/converter.git

2 - Entre na branch correta do projeto:
    
    git checkout VictorDaSilvaFernandes

3 - Entre dentro da pasta do projeto e rode o comando (Precisa ter o docker instalado em sua maquina):

    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs

4 - Assim que finalizar, rode o comando, para subir os container (precisa das portas liberadas 80, 3306, 5173, 6379, 7700, 1025, 8025)

    ./vendor/bin/sail up -d

5 - Acessar seu navegador e entra no http://localhost
