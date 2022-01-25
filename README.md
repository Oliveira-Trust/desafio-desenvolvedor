### Desafio Oliveira Truste

#### Ferramentas utilizadas

- Backend: Laravel
- ORM: Eloquent

#### Ambiente Docker

##### Requisitos

- Docker instalado e operante na máquina cliente

##### Comandos

- buildar o projeto (necessário somente na primeira vez que subir o projeto)
    - docker-compose build
- levantar o container
    - docker-compose up -d
- Executar somente na primeira vez que subir o projeto
    - docker exec -ti oliveira_api sh -c "composer install"
    - docker exec -ti oliveira_api sh -c "php artisan migrate --seed"
    - docker exec -ti oliveira_api sh -c "cp .env.example .env && php artisan key:generate && chmod -R 777 storage"
- Derrubar o container
    - docker-compose down
- Reiniciar o container
    - docker-compose restart