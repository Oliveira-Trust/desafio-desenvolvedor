

# Desafio Desenvolvedor - Desenvolvida em Laravel

#### Desenvolvido por:

<li>Claudio Martinele: clmartt@gmail.com</li>
<li>https://www.linkedin.com/in/claudio-marttinielles/</li>
<li>https://github.com/clmartt</li>



### Guia para deploy

#### Dependências
~~~
PHP v ^7.4 ou superior
Composer v2 ou superior
Nodejs npm
~~~

<p>Após a instação do PHP e Composer acesse a raiz do projeto via terminal e execute
os seguintes comandos:</p>

~~~
composer install
npm install
npm run dev
~~~

Ná raiz do projeto cópie o arquivo **.env.exemple** para a raiz do projeto com o nome **.env**
e **adicione/troque** os valores das variaveis de ambiente.



- Conexão com o banco de dados
~~~
 DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE=NOME_DO_BANCO_DE_DADOS
 DB_USERNAME=LOGIN
 DB_PASSWORD=SENHA
~~~

- Gere a chave da aplicação

~~~
 php artisan key:generate --ansi
~~~

- Crie as tabelas no banco de dados

~~~
 php artisan migrate 
~~~

- Critério de aceitação:
Deve ser possível escolher uma moeda estrangeira entre pelo menos 2 opções **OK**
- Sendo o seu valor de compra maior que R$ 1.000 e menor que R$ 100.000,00 e sua forma de pagamento em boleto ou cartão de crédito tendo como resultado o valor que será adquirido na moeda de destino e as taxas aplicadas; **OK**

Bônus:
Enviar cotação realizada por email; **OK**
Autenticação de usuário; **OK**

