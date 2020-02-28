Passo a passo de comandos para executar a aplicação.

Copiar .env.example para o .env
```
make
```

Levantar container docker (-d flag para daemon)
```
docker-compose up -d
```

Para executar comandos dentro do container
```
docker-compose exec app php artisan #comando
```

O host da API e o site Web é http://localhost:8080
