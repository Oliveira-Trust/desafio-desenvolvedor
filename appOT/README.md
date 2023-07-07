# Instruções

## Executar servidor

`
./vendor/bin/sail up
`


## Instalar dependências

`
docker exec -i appot-laravel.test-1 composer install
`

## Executar migrate

`
ocker exec -i appot-laravel.test-1 php artisan migrate

## Executar seed

`
docker exec -i appot-laravel.test-1 php artisan db:seed
`
