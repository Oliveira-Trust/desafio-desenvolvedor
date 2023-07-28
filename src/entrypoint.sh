#!/bin/bash

# Iniciar o serviço de banco de dados
##service mysql start

# Aguardar o serviço de banco de dados estar disponível
while ! nc -z db 3306; do
  echo "Aguardando conexão com o banco de dados..."
  sleep 5
done

# Criar a base de dados
mysql -h db -u root -p123456 -e "CREATE DATABASE IF NOT EXISTS laravel;"

# Executar as migrações do Laravel
php artisan migrate

# Iniciar o Nginx e o PHP-FPM
service nginx start
php-fpm
