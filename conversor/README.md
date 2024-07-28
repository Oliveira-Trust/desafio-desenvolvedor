### Ações que devem ser executadas para rodar o projeto:

1. Dar permissão de acesso aos diretórios `storage` contido na raiz da aplicação.
2. Acessar via terminal o diretório da aplicação chamado `conversor`.
3. Entrar no container do PHP no docker e rodar as migrations:
    - Digitar no terminal: `docker exec -it conversor_php /bin/bash`
    - Digitar no terminal: `php artisan migrate`
4. Rodar o comando `docker-compose up` para subir a aplicação.
5. Rodar o comando `npm run dev` para carregar Tailwind Css para estilização. (**É necessário ter instalado em sua máquina o node e o npm**).
