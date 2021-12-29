#!/bin/bash

cd /var/www
pwd

chown -R www-data:www-data .
composer install

php vendor/bin/doctrine-migrations migrate --no-interaction

/etc/init.d/apache2 start
tail -f /dev/null
