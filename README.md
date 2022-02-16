#### Pré-requisitos:
- PHP >= 8.1
    - [Windows](https://www.php.net/manual/pt_BR/install.windows.php)
    - [Ubuntu](https://computingforgeeks.com/how-to-install-php-on-ubuntu-linux-system/)
- [composer](https://getcomposer.org/download/)

#### Configuração

##### Realize a instalação das dependências do projeto executando o comando:
```
composer install
```
##### Copie o arquivo .env.example. No ubuntu, basta executar o comando
```
cp .env.example .env
```
##### Inicie o servidor artisan
```
php artisan serve
```
##### Acesse a url abaixo para visualizar a documentação da API
```
http://127.0.0.1:8000/documentacao
```
