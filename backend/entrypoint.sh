#!/bin/sh

php /usr/local/bin/composer i -o --prefer-dist --no-progress
php artisan storage:link

exec "$@"