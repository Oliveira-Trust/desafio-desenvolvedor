#!/bin/bash

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