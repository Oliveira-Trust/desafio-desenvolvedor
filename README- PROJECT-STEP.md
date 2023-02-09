`Projeto em Docker`

Fluxo de Processo de inicialização do projeto

`Subir containers em segundo plano`
# sudo docker-compose up -d

`Caso apareça esse erro de permissão -> There is no existing directory at /storage/logs and its not buildable: Permission denied, execute os comandos abaixo`
# sudo php artisan route:clear
# sudo php artisan config:clear
# sudo php artisan cache:clear

`copiar arquivo .env` 
# cp .env.example .env


`Rodar migrations`
# sudo docker exec -it phpgold-app php artisan migrate:install
# sudo docker exec -it phpgold-app php artisan migrate