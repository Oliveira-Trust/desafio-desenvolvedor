#!/bin/sh

docker-compose up -d
docker exec desafio_trust php artisan migrate --seed