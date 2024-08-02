# Conversor de Moeda





## Tecnologias

1. <a href="https://laravel.com/docs/10.x">Laravel (10.x)</a>
2. <a href="https://vuejs.org/">Vue 3</a>
3. <a href="https://redis.io/">Redis</a>
4. <a href="https://www.postgresql.org/">PostgreSQL</a>
5. <a href="https://www.docker.com">Docker</a>
6. <a href="https://tailwindcss.com">Tailwind CSS</a>



## Requisitos

1. <a href="https://www.docker.com">Docker</a>
2. <a href="https://docs.docker.com/compose/"> Docker Compose </a>
3. <a href="https://nodejs.org/en"> Node </a>



## Instalação


1. Clone o repositório
2. Copie o conteúdo de `.env.example` para `.env` e configure as varíaveis de ambiente do banco de dados.
3. Na pasta raiz do projeto execute o comando `docker-compose up -d` e espere ser construída os containers
4. Após a construção **entre** no container **app** com o comando `docker-compose exec app bash`.
5. Os comandos a seguir são executados **dentro** do container **app:**
    1. Execute o comando `composer install`
    2. Execute o comando `php artisan key:generate`
    3. Execute as migração com `php artisan migrate`
    4. Execute o comando `php artisan db:seed`

6. Em seguida a aplicação vai rodar em `http://localhost:8000`
7. (opcional) Caso tenha um erro de acesso ao diretório storage, execute o comando `chmod -Rf 0777 storage` na raíz do projeto.
8. Obs: Eu já fiz o build do javascript, mas caso você deseja alterar o código JS terá que fazer o build em tempo de execução  então instale o node e execute o comando `npm install` e `npm run dev` no projeto.

### Sobre o desafio

Foram feitos **todos** os requisitos do desafio proposto





