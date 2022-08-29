# Desafio desenvolvedor PHP (Jr/Pleno/Sênior)
##### Desenvolvido por Gabriel Torres Brum
&ensp;
## ✨  Instruções para visualização do projeto

##### Crie o arquivo de variável de ambiente
```sh
    cp .env.example .env
```
##### Configure para utilizar sqlite 
```sh
    DB_CONNECTION=sqlite
    # DB_HOST=127.0.0.1
    # DB_PORT=3306
    # DB_DATABASE=desafio_oliveira_trust
    # DB_USERNAME=root
    # DB_PASSWORD=
```
##### Instale as dependências
```sh
    composer install
    yarn // dependencias node
    yarn build
```

##### Execute as migrations e as seeders
```sh
    php artisan migrate:fresh --seed
```

##### Execute o comando para limpar o cache e otimizar o projeto
```sh
    php artisan optimize:clear
    php artisan optimize
```

##### Execute o projeto localmente
```sh
    php artisan serve
```

##### Acesse o projeto em http://localhost:8000
&nbsp;
##### Usuários para testes
###### Administrador
Email: admin@email.com
Senha: 12345678
###### Usuário
Email: user@email.com
Senha: 12345678
