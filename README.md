### Instalação Keycloak:
 - Entrar na pasta keycloak e subir o container com o comando "docker-compose up --build"
### Instalação Lumen:
 - Documentação laradock https://laradock.io/ para instalação da biblioteca.
 - Para instalar o laradock basta entrar na pasta api-lumen-back e fazer um "git submodule add https://github.com/Laradock/laradock.git" ou git "clone https://github.com/laradock/laradock.git"
 - Após o container do keycloak subir, entrar na pasta api-lumen-back/laradock criar um arquivo .env e copiar o .env.example para ele.
 - Entrar na pasta api-lumen-back criar um arquivo .env e copiar o .env.example para ele e executar o comando "composer install".
 - Entrar na pasta api-lumen-back/laradock novamente e rodar o comando "docker-compose up nginx mysql phpmayadmin".
 - Após o container do laradock subir, entrar no terminal do container com o seguinte comando "docker-compose exec --user=laradock workspace bash"
 - Uma vez dentro do terminal do container laradock, rodar o comando "php artisan migrate" e em seguida "php artisan db:seed".

### Instalação React:
 - Após o container do laradock subir, entrar na pasta react-front e rodar o comando "docker-compose up --build"
 - Este comando já irá gerar o .env à partir do .env.example.
### Uso Keycloak:
 - Para acessar o painel administrativo do keycloak terá que abrir a url localhost:8084 no seu browser e clicar em Administration Console.
 - À partir desse ponto irá abrir a tela de login onde o username e a senha seram admin.
 - Confirme se o Realm "PHP-Developer-Test" existe passando o mouse abaixo do logo do Keycloak.
 - Confirme se os clients "lumen" e "react" existem clicando em Clients.
 - Verifique se em Users clicando em "View all users" existem 2 usuários cadastrados.
### Uso React:
 - O React estará rodando na porta 3002.
### Uso Api Lumen:
 - O Lumen estará rodando na porta 8081
 - Haverão dois endpoints disponíveis "http://localhost:8081/api/converted-values" com os métodos POST e GET.
 - Exemplo de payload de cadastro: {"originValue":5000,"convertedCurrency":"EUR","paymentMethod":"CREDIT_CARD"}
