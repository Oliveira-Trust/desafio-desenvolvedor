### Desafio:

Olá, completei o desafio incluindo as opções de bônus para: 

- Armazenar histórico;
- Autenticar usuário;
- Enviar e-mail com a cotação;
- Alteração das configurações de taxas;

Para a consulta do câmbio via API, optei usar uma interface para que possa ser utilizado outras APIs caso necessário.

Criei algumas migrations para armazenar os dados nas tabelas, neste projeto usei o SQLite para facilitar mas pode ser construindo em MySQL também.

Criei dois Seeders para criação do usuário teste para autenticação e outra para inserir os dados das taxas na tabela de configurações.

Publiquei o projeto em um servidor e pode ser acessado com os dados abaixo:

http://150.230.80.10/
Usuário: teste@teste.com
Senha: teste

Algumas telas da aplicação:


### Login
<img src="http://150.230.80.10/desafio/login.jpg">

### Conversão
<img src="http://150.230.80.10/desafio/conversao.jpg">

### Resultado
<img src="http://150.230.80.10/desafio/resultado.jpg">

### Histórico
<img src="http://150.230.80.10/desafio/historico.jpg">

### Configurações
<img src="http://150.230.80.10/desafio/configuracoes.jpg">

### E-mail
<img src="http://150.230.80.10/desafio/mailtrap.jpg">

