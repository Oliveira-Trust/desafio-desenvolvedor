# Como executar a aplicação
````
git clone https://github.com/theusrsilva/desafio-desenvolvedor/tree/Matheus-Rocha-Da-Silva
````
Já dentro do repositório pelo terminal
````
cp .env.example .env
preencha ao menos as configurações de banco de dados
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
````
Caso queira usar o recurso de esqueci a senha tera que preencher dos e-mails.
Uma boa solução é usar o mailtrap para teste.
após isso ainda no terminal use os seguintes comandos para instalar a aplicação
````
composer install
composer dump-autoload
php artisan key:generate
npm install 
npm run dev
````
Com algum mysql rodando utilize o seguinte comando para rodar as migrations.
Nos meus testes utilizei o xampp para ser mais rápido e por estar no windows,
porém uma configuração com docker é o ideal.
````
php artisan migrate
php artisan serve

a aplicação estará rodando na seguinte url
http://127.0.0.1:8000/
````


## Esquema do BD

![alt text](https://github.com/theusrsilva/desafio-desenvolvedor/blob/Matheus-Rocha-Da-Silva/public/images/BD.png)
