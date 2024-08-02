# Desafio OLIVEIRA TRUST

Esse é o desafio técnico para vaga de desenvolvedor na Oliveira Trust

---

## Requisitos / Tecnologias utilizadas

- Composer
- Docker
- Docker Compose
- PHP 8.3
- Laravel 11
- TailwindCSS
- NodeJs
- NPM
- Alpine Js
- MySQL
- Redis
- Mailpit
- Laravel Sail
- PestPHP
- Laravel Pint
- Larastan
- PHP CodeSniffer

---

## Executando o sistema

> Esse projeto foi desenvolvido utilizando o Laravel Sail.

Acesse a do projeto pelo terminal e execute o comando `composer install`, após a instalação dos pacotes, execute os comandos `cp .env.example .env` e `./vendor/bin/sail artisan key:generate`. Execute também os comandos `npm install` e `npm run build`.

Para iniciar o projeto, basta executar o comando `./vendor/bin/sail up -d`, com esse comando serão iniciados os containers docker que a aplicação precisa, incluindo o banco de dados MySQL.

> Para acessar o sistema acesse a url: http://localhost

Existem migrações e seeders a serem executados, então execute o comando `./vendor/bin/sail artisan migrate --seed`

#### Usuários do sistema:
| Usuário | Email             | Senha    |
| ------- | ----------------- | -------- |
| Admin   | admin@example.com | password |
| Usuário | user@example.com  | password |

O projeto usa filas para execução em segundo plano do envio de e-mail e persistencia dos dados de cotação realizados. Então é necessario inicar o work de filas com o comando `./vendor/bin/sail artisan queue:work`.

> Para ver os e-mails recebidos acesse a url: http://localhost:8025/

---

Desafio desenvolvido por [Ewerton Motta](https://github.com/EwertonMotta)
Repositório do desafio: [Ewerton Motta - Desafio Desenvolvedor](https://github.com/EwertonMotta/desafio-desenvolvedor)
Link com regras do desafio: [OLIVEIRA TRUST - Desafio Desenvolvedor](https://github.com/Oliveira-Trust/desafio-desenvolvedor/blob/master/vaga.md)
