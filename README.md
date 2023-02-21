### Sobre o Projeto:

Trata-se de um desafio técnico (conversor de moedas) proposto pela [Oliveira Trust](https://github.com/Oliveira-Trust/desafio-desenvolvedor/blob/master/vaga.md) para o cargo de Desenvolvedor PHP.

  
#### O que é preciso para executar: 🧪
Este projeto parte da premissa que você já tenha o docker instalado em sua máquina e que também esteja usando ambiente linux (ainda que via WSL).

 1. Após clonar, entrar no diretório e mudar de branch
```sh
git checkout feature/magno-santana-da-silva
```

2. Executar:
```sh
docker-compose up -d
```
Serão executados os serviços do apache, php-fpm, redis e mailhog. Caso haja algum conflito de portas que impeça a execução de algum serviço fique a vontade para alterar no arquivo ***docker-compose.yml*** presente na raiz do projeto.

3. Agora o arquivo ***.env.example*** deve ser copiado para um novo chamado apenas ***.env*** para isso execute:
```sh
docker exec -it ms_phpfpm cp .env.example .env
```
4. Agora instale as dependências php do projeto
```sh
docker exec -it ms_phpfpm composer install
```
5. Conceda permissões de escrita nos diretórios *storage* e *bootstrap/cache*:
```sh
sudo chmod 777 -R storage/
```
```sh
sudo chmod 777 -R bootstrap/cache/
```
6. Agora precisamos rodar as *migrations* e popular o banco de dados com as informações iniciais. No arquivo .env já possui uma configuração de um banco remoto. Caso queira, fique a vontade para informar os dados de acesso de um outro banco de dados... 
```sh
docker exec -it ms_phpfpm php artisan migrate:fresh
```
```sh
docker exec -it ms_phpfpm php artisan db:seed
```
7. Pronto, neste momento você ja deve ser capaz de acessar a aplicação no endereço http://localhost:8081/ ou em outra porta, caso você tenha alterado no arquivo ***docker-compose.yml***.

![enter image description here](https://magnosanttana.com.br/desafio-oliveira-trust/conversor-moeda-tela-login.jpg)

**Para logar use os dados:**
Email: *joao@email.com* ou entao *maria@email.com*
Senha: *12345678*

 **📨 Envio da conversão por email**
 Sempre que uma conversão for feita a mesma será enviada para o email do usuário logado.
 Para que você possa conseguir visualizar o email basta acessar a url http://localhost:8025/ onde estará rodando o serviço *mailhog*. 
 *Caso você tenha alterado a porta, lembre de alterar esta informação no arquivo .env*
#### O conversor também pode ser usado via terminal😍

Para isso basta executar o comando:
```sh
docker exec -it ms_phpfpm php artisan converter-moeda
```
![enter image description here](https://magnosanttana.com.br/desafio-oliveira-trust/conversor-moeda-terminal.jpg)



#### Meu contato :sunglasses::

- Email: contato@magnosanttana.com.br

- LinkedIn (https://www.linkedin.com/in/magnosanttana)
