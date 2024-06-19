# Desafio Desenvolvedor - Gabriel Santos Carvalho

## Tecnologias e Frameworks
    - PHP
    - Laravel
    - MySQL

## Instruções para Utilização do Sistema Conversor de Moedas

Realize o clone do repositório.

Logo após, a primeira configuração à ser realizada é a criação do arquivo .env, pois nele serão setadas as variáveis do Banco de Dados MySQL e envio de E-mail via SMTP, o arquivo .env.example demonstra como devem ser realizadas as configurações.

Em seguida, certifique-se que você tenha o PHP 8.0+ e o Composer instalados.

Após isso, execute o seguinte comando na raiz do projeto para instalar suas dependências
<br />
```bash
composer install
```
Execute o comando abaixo para estruturar o Banco de Dados:
```bash
php artisan migrate
```
Com isso, basta executar o seguinte comando e o Sistema deve funcionar perfeitamente:
<br />
```bash
php artisan serve
```