Passo a passo para executar a aplicação.

Copiar .env.example para o .env
```
make
```

Levantar container docker (-d flag for daemon)
```
docker-compose up -d
```

Executar comandos dentro do container
```
docker-compose exec app PHP artisan
```

O host da API e o site Web é http://localhost:8080
