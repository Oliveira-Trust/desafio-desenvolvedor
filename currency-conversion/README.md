Aplicação de conversão monetária criada em láravel/mysql

#instalação
1. Renomear .env.example para .env
2. Instale o composer https://getcomposer.org/
3. Após a instalação execute no terminal composer instal
4. Execute a instalação do nodejs https://nodejs.org/en/download/
5. Execute a instalação do yarn(https://classic.yarnpkg.com/lang/en/docs/install/) 
   ou npm (https://docs.npmjs.com/cli/v6/commands/npm-install)
6. Execute yarn install ou npm install
7. Executar as migrations php artisan migrate
8. Inserir o primeiro usuário na base de dados com php artisan db:seed --class=UserSeeder
   Acesse a base no mysql para verificar o email de login que é gerado aleatóriamente, 
   a senha é padrão para todos os usuários: password
   Inserir as configurações do sistema php artisan db:seed --class=ConfigurationSeeder
