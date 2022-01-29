# Conversor de Moedas

    Aplicação para conversão de moedas.

## Obrigatório ter instalado no computador:
- PHP 8.1
- Composer
- Docker

### Como inciar o projeto
- #### Instalar dependencias
    - No terminal, dentro do projeto `conversor-moedas/` é necessário executar o comando `composer install`
- #### Configurar .env
    - É necessário realizar uma cópia do `.env.example` e renomear como `.env`, pode ser feito utilizando o comando `cp .env.example .env`
- #### Subindo a aplicação local
    - Será utilizado o docker para rodar a aplicação, por meio do Laravel/Sail. Execute o comando `./vendor/bin/sail up -d`
- #### Gerando APP_KEY
    - Utilizar o comando `./vendor/bin/sail artisan key:generate` para gerar a APP_KEY da aplicação Laravel.

### Após ter inciado o projeto
- #### Aplicar migrations
    - Aplicar migrations `./vendor/bin/sail artisan migrate`(utilizar o ` --seed` caso seja para testes locais. Vai adicionar um usuário teste).
- #### Consultar valores monetários
    - Para ter os dados da api de moedas, é preciso executar o comando `./vendor/bin/sail artisan coin_prices`.
- #### Manter valores monetários atualizados
    - Utilizar o comando `./vendor/bin/sail artisan schedule:work`, isso iniciará o scheduler, fazendo ele executar o primeiro comando a cada 5 minutos, até que seja cancelado o comando pelo terminal.

