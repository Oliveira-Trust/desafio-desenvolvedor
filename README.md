
### Dados técnicos
```
PHP: 8.0.0
Lumen: 8.0
Mysql: 8.0.19
```

### Configuração

cp .env.example . env

```
php artisan key:generate

php artisan jwt:secret

obs: antes de rodar o próximo comando criar um banco no mysql db_test.

php artisan migrate

