### Instalação:
- composer install <br />
- Criar um arquivo .env à partir do arquivo .env.example <br />
- php artisan key:generate <br />
- configurar o user, port e password do banco da sua maquina no arquivo .env <br />
- Criar uma tabela no banco com o mesmo nome da tabela do .env <br />
- php artisan migrate --seed <br />
- php artisan serve<br /><br />

Os usuario já criados são : <br />
**admin@trust.com** - user com permissão de admin  <br />
senha: **123456789** <br />
**karen@trust.com** - user com permissão comum <br />
senha: **123456789**

<br />

### Design patterns utilizados no teste:
**DDD** <br/>
Para separação de pastas, arquivos e domínios <br />
ref: https://julio-falbo.medium.com/minha-vis%C3%A3o-de-desenvolvedor-sobre-domain-driven-design-ddd-841afbe2fbc7 <br />  <br />


**Service-Repository** <br/>
Trabalhando o conceito de separação de responsabilidades das classes. <br />
ref: https://dev.to/jsf00/implement-crud-with-laravel-service-repository-pattern-1dkl  <br />  <br />

**Strategy** <br/>
Usando o conceito de separar a regra de negócio de cada tipo de pagamento por classes, e instanciando elas dinamicamente e importando as regras de cada tipo de pagamento.  <br />
ref: https://blog.caelum.com.br/entendendo-o-pattern-strategy-em-php/amp/ <br />  <br />

**Gateway** <br/>
Utiliza um conceito parecido com o Strategy, mas é utilizado para chamadas de serviços, APIs ou dados externos em geral <br />
ref: https://martinfowler.com/articles/gateway-pattern.html  <br />  <br />


### Obs:
A tabela fees foi criada com strings como valores por uma questão de tempo de entrega, o correto seria os valores serem foreign keys de outras tabelas. <br />
