# Indice

- [Sobre](#sobre)
- [Funcionalidades desenvolvidas](#funcionalidades-desenvolvidas)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Dependências](#dependências)
- [Instalando o docker](#instalando-o-docker)
- [.Env](#.env)
- [Como baixar o projeto](#como-baixar-o-projeto)
- [Rodando ambiente com Docker](#rodando-ambiente-com-docker)
- [Usuário e Senha do sistema](#usuário-e-senha-do-sistema)
- [Observações](#observações)

## Sobre

Projeto de desafio de desenvolvedor no qual o sistema realiza conversões de moeda de acordo com a cotação baseada na api do 
[economia.awesomeapi.com.br](economia.awesomeapi.com.br).


---
## Funcionalidades desenvolvidas

- Autenticação de usuário e senha.
- Realização de Conversão de moedas.
- Registro de histórico de conversões.
- Alteração de taxas de pagamento.


---

## Tecnologias utilizadas

O projeto foi desenvolvido utilizando as seguintes tecnologias

- [PHP:7.4](https://www.php.net)
- FrameWork [Laravel:8](https://laravel.com)
- [Mysql:5.7](https://www.mysql.com)
- [Nginx](https://www.nginx.com)
- [Reactjs](https://pt-br.reactjs.org)
- [Material.io React](https://mui.com/pt/)
- [Axios](https://github.com/axios/axios)
- [Docker](https://www.docker.com)

---

## Dependências

```bash

    - Docker
    - WSL (para ambientes Windows)
```

## Instalando o Docker

O **Docker** pode ser baixado através do [https://www.docker.com](https://www.docker.com). Caso esteja utilizando ambiente Windows, é necessário instalar o WSL (Windows Subsystem for Linux) através do [link](https://docs.microsoft.com/pt-br/windows/wsl/install).

---

## .Env

A fins de avaliação e teste, mantive os dados reais de produção no ".env.example" no diretório. 
Realizar uma cópia para ".env".

## Rodando ambiente com Docker

Acesse o diretório em que o repositório foi clonado através do terminal e
execute os comandos:
 - `docker-compose build` para compilar imagens, criar container etc.
 - `docker-compose up -d` para inicializar os container.
 - `docker-compose down` para encerrar os contâiners.

** Observação: Certifique que no repositório contenha os arquivos `Dockerfile` e `docker-compose.yml`
---

## Passo a Passo de configuração do laravel

Após o ambiente docker iniciado, utilize o comando dentro do diretório `docker ps` e localize o container `php-nginx`. 
Copie o ID do contâiner e realize o comando `docker exect -it <id_container> bash` e execute os seguintes comandos:
- `composer install` para instalar todas depências do projeto.
- `php artisan migrate:refresh --seed` para criar todas as tabelas da base de dados e para popular o banco com alguns dados.
- `php artisan config:clear` para limpar o cache de configuração ( referente as variáveis de ambiente).

## Usuário e Senha do sistema
---
Login: caio.kozano@live.com
Senha: teste123

URL APi = http://localhost
URL Front = http://localhost:8080

---

## Observações
 - O front-end **Reactjs** se encontra dentro do diretório "/front-react" já no formato de build.

Desenvolvido por Caio Kozano.