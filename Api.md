### Table Name

```
tablename:peoples, é preciso rodar o comandos artisan logo a baixo para carregar as tabelas!
```

### Endpoints

```
./postman-collections
```

### Dependências usar commands

```
composer require laravel/passport
step 1 php artisan migrate

step 2 "Personal access client not found. Please create one." se não, erro quando logar
php artisan passport:install

-- Esqueci para que serve o comando a baixo.
composer require peterpetrus/passport-token
```

### Necessário se quer pegar erros de permissão, uso do chmod, para desblockear e limpar erros

```
sudo chmod 777 -R laravel-8-test/
php artisan cache:clear
```

### Guia de registrar usuário novo, login e get token

-   local/public/api/v1/register
-   Required

```
'name' => 'required',
'email' => 'required|email',
'password' => 'required',
'c_password' => 'required|same:password',
```

### Guia para logar e ter o token como resposta

```
- local/public/api/v1/login
- Required

'email' => 'required|email',
'password' => 'required',

```

### sempre que você fazer solicitação, você precisa autenticar.

```
    - Teste authentication just remove token from header
    - get error from middleware \App\Http\Middleware\AuthApiForToken::class
```

### Depois disso você ta Authorized fazer request nessa lista de endpoints

```
All request (create
=> 'local/public/api/v1/create'
,delete
=> 'local/public/api/v1/deleteAll'
,all
=> 'local/public/api/v1/selectAll'
,read specify data
=> 'local/public/api/v1/selectBy'
)
```

### register task required, Playload de erros de validação do midleware!

-   Error of validation data

```
{
    "success": false,
    "message": "Validation Error.",
    "data": {
        "full_name": [
            "The full name has already been taken."
        ]
    }
}
```

[Return out back](https://github.com/devnaelson/laravel-8-test/tree/convertCurrencyInit)
