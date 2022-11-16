# Desafio tecnico Oliveira Trust:
O projeto foi desenvolvido como parte do processo seletivo de desenvolvedor plen back-end na Oliveira Trust

## Configuração do ambiente:
O projeto foi desenvolvido utilizando docker tanto no front-end quanto no back-end, no back-end foi utilizado o Laravel Sail, solução do Laravel para facilitar a utilização do docker, por isso manti os docker-compose.yml separados.
Para o front-end não temos muito segredo, acesse a pasta client e execute o comando 
```bash
docker-compose up
```
Pode-se utilizar a flag -d para liberar o terminal, mas não recomendo utilizar na primeira vez, visto que será mais difícil identificar um possível erro.

Para o back-end, por ter utilizado o Sail, devemos instalar a dependência do projeto com o `php composer install` para a execução (recomendo seguir o tutorial padrão do [Laravel Sail](https://laravel.com/docs/9.x/sail#introduction)) e utilizar o comando
```bash
bash ./vendor/bin/sail up
```

Caso tenha sucesso, o endereço `http://localhost:8081` estará disponível e pronto para utilização do projeto.

## Considerações:
Por estar utilizando o sail, tenha preferência por substituir os comandos iniciados em `php artisan ...` por `bash ./vendor/bin/sail artisan ...`.
Não esqueça de copiar o .env.example criando o arquivo .env e gerando a key do projeto com o comando `bash ./vendor/bin/sail artisan key:generate`.
Por ter sido feito critérios bônus de autenticação/histórico, é necessário rodar as migrations para criação das tabelas: `bash ./vendor/bin/sail artisan migrate`.
Caso queira realizar consulta para verificar o banco de dados, pode-se utilizar o [Tinker](https://laravel.com/docs/9.x/artisan#tinker): `bash ./vendor/bin/sail artisan tinker`.


## Testes:
Foram criados testes na API, caso queira executá-los, utilize o comando:
```bash
bash ./vendor/bin/sail test
```
Também é possível passar a flag `--coverage` para gerar a porcentagem de cobertura de testes do projeto.

## Envio de email:
Criei a classe de envio de email e parte da implementação, quando fui pego de surpresa com a noticia de que o gmail não permite mais o acesso a apps menos seguros, [leia](https://myaccount.google.com/lesssecureapps?pli=1&rapt=AEjHL4NRU_E-a2rHdOexADhYNBnJg3Syued55t10XSECEtNmBcJlCsqL_jtU6IR_0TqDBi4nVQGobpbDaIs5fERp03KtFwUsZg)
Com isso, o disparo de email não ficou completamente funcional.