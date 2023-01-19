###Sistema de cotações 

## primeiro deve copiar o arquivo .env.example para .env
depois de setar os dados do banco
basta rodar os comandos abaixo

php artisan install:data

pronto agora basta rodar

php artisan serve

Dados de login adminstrador 

adm@gmail.com
123456

Existe a possibilidade do usuario fazer o cadastrou ou apenas cotar
seM IDENTIFICAR mas a cotação eh armazenada.

Para ativar o email 
altere o flag em env para 
APP_ENABLE_EMAILS=TRUE

Dentro perfil admintrador existe a possibilidade de alterar os parametros de negocio
como taxas, valor minimo, etc, na barra superior do menu

Dentro do barra temos a opção de moedas que são quais as moedas podem ser convertidas
Caso queria trabalhar com outra base de moeda 
basta alterar o código 
API_BASE_COIN="BRL"
e rodar o comando php artisan coins:sync