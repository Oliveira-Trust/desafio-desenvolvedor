# SISTEMA DE COMPRAS - OLIVEIRA TRUST

Pequeno guia sobre o sistema de compras, contendo os diretórios importantes, manual de instalação e um pouco sobre o projeto,
quaisquer dúvidas, basta entrar em contato comigo!


## ⌚ DESENVOLVIDO EM 12 HORAS e 35 MINUTOS (APROXIMADAMENTE)
- Para medir, foi utilizado o cronômetro online do site -> [Relógio Online](https://relogioonline.com.br/cronometro)

## ☕ URL DO SISTEMA NO MEU SERVIDOR (PARA POUPAR TEMPO)

- CLIQUE PARA ACESSAR O -> [SISTEMA DE COMPRAS - OLIVEIRA TRUST](www.oliveiratrust.cp2studentsagency.com.br)

## ☕ Versão do PHP

- PHP >= 7.3 OU 7.4.12

## 🔔 AVISO

```php
ob_start()
```
- Adicione a linha "ob_start()" Ao colocar o site no CPANEL, SE FOR EM LOCALHOST NÃO PRECISA! [ARQUIVO DA LINHA](index.php) 



## ✅ CRIANDO O BANCO DE DADOS 


- 1 ) Para encontrar o arquivo do banco de dados, vá até -> [ESTE DIRETÓRIO](/Banco_de_dados).

- 2 ) Agora basta pegar o arquivo em .SQL e importar para o seu [BANCO DE DADOS](/vendor/oliveiraTrust/src/DB/Sql.php).


## ✅ CONECTANDO O BANCO DE DADOS 

- PARA DEFINIR O LOGIN DO BANCO DE DADOS, VÁ ATÉ -> [ESTE DIRETÓRIO](/vendor/oliveiraTrust/src/DB/Sql.php).


## 🔔🔔 AVISO IMPORTANTÍSSIMO 

Este arquivo .SQL contém 4 (QUATRO) STORAGE PROCEDURES, são elas :

- [sp_addresses_update](vendor/oliveiraTrust/src/Model/Address.php)

- [sp_products_update](/vendor/oliveiraTrust/src/Model/Products.php)

- [sp_purchases_update](/vendor/oliveiraTrust/src/Model/Purchase.php)

- [sp_users_update](/vendor/oliveiraTrust/src/Model/User.php)

Se assegure de que as quatro Storage Procedures estão presentes no seu banco de dados!



## 🛍️ Bibliotecas/Frameworks Utilizados

Obs : para um sistema deste nível, optei por não utilizar Laravel, pelo motivo de "Utilizar uma serra elétrica pra cortar uma folha de papel", em outras palavras, 
a biblioteca do Laravel é muito ampla, e este sistema é bem pequeno, com isso, escolhi utilizar frameworks mais simples para produção do mesmo.

Frameworks escolhidos : 
```php
echo ("Slim Framework" . " & " . "Rain TPL");
```
Bibliotecas Utilizadas :
```javascript
alert (" Bootstrap ( CSS & JS ) " + " PORTO TMT " + " PLUGINS SECUNDÁRIOS EX : DATATABLES (TABELAS) ");
```
Banco de dados / Estruturas de dados :
```php
var_dump( array( 'MySql', 'JSON', 'AJAX' ) );
```


## 📌 Diretórios Importantes

- [DIRETÓRIO DOS ARQUIVOS HTML](/views)
- [DIRETÓRIO DOS ARQUIVOS JS/CSS/IMAGENS](/res)
- [DIRETÓRIO DOS ARQUIVOS PHP](/Pages)
- [DIRETÓRIO DAS CLASSES (PHP)](/vendor/oliveiraTrust/src/)
- [DIRETÓRIO DO BANCO DE DADOS](/vendor/oliveiraTrust/src/DB/Sql.php)

- [ARQUIVO PARA IMPORTAR O BANCO DE DADOS](/Banco_de_dados/db_oliveira.sql)


## 🔏 Modificação no .HTACCES para forçar HTTPS 
- RewriteCond %{HTTPS} off 
- RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]


## 🔐 CONTA DE ADMINISTRADOR PADRÃO
- Login : vto.hugo67@gmail.com
- Senha : 123321

OBS : No servidor em que deixei o [LINK](www.oliveiratrust.cp2studentsagency.com.br), a senha pode ser outra, pois qualquer um que entrar e tiver este login e senha vai poder modificar, porém, por padrão ao importar o arquivo SQL para o banco de dados, essa é a conta padrão de ADM.

## 🔐 CONTA DE USUÁRIO DE EXEMPLO
- Login : glaucio@gmail.com
- Senha : 123321

OBS : Esta é apenas um conta de testes já pré-feita, é fortemente recomendado que você crie uma nova conta para fazer os devidos testes como Usuário (Comprador/Vendedor).




## 🚪 Aviso Final

QUALQUER DÚVIDA ENTRAR EM CONTATO!

- VITOR HUGO BRANDÃO SANTANA
- RIO DE JANEIRO - RJ
- PROGRAMADOR FULL STACK - PLENO
- COLÉGIO PEDRO II (FEDERAL)
- vto.hugo67@gmail.com

