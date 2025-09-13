#!/bin/bash

cd docker || exit 1

if command -v docker-compose &> /dev/null; then
    docker-compose up --build
    docker exec -it desafio-app php artisan migrate && php artisan db:seed --class=UserSeeder
elif docker compose version &> /dev/null; then
    docker compose up --build 
    docker exec -it desafio-app php artisan migrate && php artisan db:seed --class=UserSeeder
else
    echo "Nenhum docker-compose encontrado!"
    exit 1
fi