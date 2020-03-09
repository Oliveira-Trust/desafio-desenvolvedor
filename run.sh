cp .env.example .env

docker-compose up&

docker-compose exec php bash -c "composer install"

docker-compose exec php bash -c "php artisan key:generate"

chmod -R 777 storage

docker-compose exec php bash -c "php artisan migrate"
