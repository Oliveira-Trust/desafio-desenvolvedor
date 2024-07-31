### Ações que devem ser executadas antes de rodar o projeto:

1. Acessar o diretório da aplicação chamado: `coversor`

### A aplicação está configurada para rodar via docker:

1. Abrir o terminal certificando-se de estar na pasta `conversor` que é a pasta da aplicação.
2. Dar permissão de acesso aos diretórios `storage` contido na raiz da aplicação.
    - Digitar no terminal: `sudo chmod -R 777 /storage`
3. Subir a aplicação executando os comandos abaixo no terminal:
    - `docker compose up -d`
    - `npm run dev` (_É necessário ter instalado em sua máquina o node e o npm_).
4. Acessar o container do PHP no docker e rodar as migrations e seeders:
    - Digitar no terminal: `docker exec -it conversor_php /bin/bash`
    - Digitar no terminal: `php artisan migrate`
    - Digitar no terminal: `php artisan db:seed`
5. Abrir o navegador e digitar o seguinte endereço para acessar a aplicação:
    - `http://localhost:8000`
