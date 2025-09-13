#!/bin/bash

cd docker || exit 1

if command -v docker-compose &> /dev/null; then
    docker-compose up --build
elif docker compose version &> /dev/null; then
    docker compose up --build 
else
    echo "Nenhum docker-compose encontrado!"
    exit 1
fi