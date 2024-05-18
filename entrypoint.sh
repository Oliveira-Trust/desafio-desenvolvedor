#!/bin/bash

cd /var/www/html/app/

cp .env.example .env

php artisan migrate --force >> /var/log/laravel.log
