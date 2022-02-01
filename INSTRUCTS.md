
### Iniciando a aplicação

  

1 - Para inicializar os containers execute o comando abaixo:

  

```

docker-compose --env-file ./money-converter/.env up -d --build

```

  

2 - Instale as dependencias dos projetos:

  

```

# para a aplicação money-converter

docker-compose exec money-converter composer install

  

# para a aplicação mail-service

docker-compose exec mail-service composer install

```

  

2 - Execute as migrations da aplicação com o comando:

  

```

docker-compose exec money-converter php artisan migrate

```

3 - Execute as Seeds da aplicação com o comando:

  
```

docker-compose exec money-converter php artisan db:seed

```

### Dependências do Projeto

- Redis: [clique aqui](https://redis.io/)
- RabbitMQ: [clique aqui](https://www.rabbitmq.com/)
- Mysql: [clique aqui](https://www.mysql.com/)


### Conceitos ultilizados

- CircuitBreaker: [clique aqui](https://laravel-news.com/circuit-breaker-pattern-in-php)

- Domain oriented Laravel: [clique aqui](https://stitcher.io/blog/laravel-beyond-crud-01-domain-oriented-laravel)
