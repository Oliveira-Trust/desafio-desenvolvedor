# Requirements
- [ ] [composer](https://getcomposer.org/download/) 
- [ ] [docker](https://docs.docker.com/get-docker/)
- [ ] [git](https://git-scm.com/downloads)

# Instructions

## Go to the folder (if you dont)

```sh
cd currency-converter
```

## Run composer install

```sh
composer install
```
> if it fails:
> ```sh
> composer install --ignore-platform-req=ext-fileinfo --ignore-platform-req=ext-fileinfo
> ```

## Start docker services

```sh
docker-compose up
```

after services is ready to listen
- mariadb
- currency_converter
- mailhog (dont dispatch email, it will just log for you)

## Run migrate

```sh
docker exec currency_converter php artisan migrate --seed
```

## Run Yarn Install 
```sh
docker exec currency_converter yarn install
```

## Run Yarn Run Dev 
```sh
docker exec currency_converter yarn run dev
```

## (Optional) You can access database with connection:

Key | Value
-- | --
Host | localhost
Port | 3306
User | cc_user
Password |

> Yes! No passwords here... free access, baby! (No risky because it's a development environment hehe :eyes: ) 

## Test like a user

You can go at http://localhost/ now and exchange some money :money_with_wings: or

## Test like a nerd

a. if you wanna pay with `credit-card` use something like this:

```sh
curl --request POST \
  --url http://localhost/api/currency-converter/buy \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
	"paymentType": "credit-card",
	"destinationCurrency": "EUR",
	"value": 5000
}'
```

b. if you wanna pay with `billet` use this:
```sh
curl --request POST \
  --url http://localhost/api/currency-converter/buy \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
	"paymentType": "billet",
	"destinationCurrency": "EUR",
	"value": 5000
}'
```

(easter-egg) pix available if u are a really nerdy :p
