
## Sobre o  Projeto

Aplicação para converter modedas do tipo BRL para outros tipos utilizando uma API de cotação da moeda de destino.

A aplicação faz a conversão dos valores aplicando taxas de pagamento e de conversão por valor, é feito o armazenamento de transações no banco de dados e o envio de email contendo os dados da transação. 

## Inicializar o projeto

Baixar imagens e iniciar pelo docker
```
docker-compose up -d
```
Entrar no container
```
docker-compose exec app bash
```
Copiar e renomear o arquivo .env.example
```
cp .env.example .env
```
Instalar as dependências pelo composer
```php
composer install 
```

Gerar chave
```
php artisan key:generate
```

Instalar assets CSS e JS
```
npm install && npm run build
```
Execultar os testes
```
composer test
```

Execultar pint
```
composer pint
```

Rodar as migrations do banco de dados
```
php artisan migrate
```

Abrir aplicação no navegador
```
http://localhost
```

Criar um usuário e logar no sistema para fazer as conversões.


Para vizualizar o cliente de email no navegador
```
http://localhost:8025
```

