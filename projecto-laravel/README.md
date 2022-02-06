## Teste Técnico


## Instalação
# Renomeie o arquivo .env.example para .env

# executar: composer install

# executar: npm i

# executar: npm run dev

# Configurar no .env
> DB_CONNECTION
> DB_HOST
> DB_PORT
> DB_DATABASE
> DB_USERNAME
> DB_PASSWORD

> CONFIG_ID [1]
> DEFAULT_ORIGIN_CONVERTION_CURRENCY - Moeda de origem (padrão) para origem de conversão [BRL]

# Executar 
> php artisan migrate:install
> php artisan migrate
> php artisan db:seed

# Acessar
http://LINK_DO_PROJETO_INSTALADO
