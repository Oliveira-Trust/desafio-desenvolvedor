# PROJETO API BACKEND PHP FRONTEND REACTJSCONVERÇÃO DE MOEDAS#


---

Projeto desenvolvido com estrutura RESTFull Backend em PHP, Banco de dados MySQL, Frontend com ReactJS utilizando algumas biblioteas PHP/JavaSCript.
Foi utilizado Docker e docker-compose para o desenvolvimento

<p align="center">	
   <a href="https://www.linkedin.com/in/developer-danielmn/">
      <img alt="Daniel Meireles" src="https://img.shields.io/badge/-Daniel Meireles-0080000?style=flat&logo=Linkedin&logoColor=white" />
   </a>
  <img alt="Repository size" src="https://img.shields.io/github/languages/code-size/meirelesdev/base-docker?color=0080000label=repo%20size">


  <a href="https://github.com/meirelesdev/base-docker/commits/main">
    <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/meirelesdev/base-docker?color=0080000">
</p>

# :pushpin: Índice

- [Sobre](#sobre)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Como Usar](#como-usar)
- [Como Contribuir](#como-contribuir)

<a id="sobre"></a>

## :bookmark: Sobre

O <strong>Projeto Converção de moedas</strong> é um projeto desenvolvido consumindo a api: [https://docs.awesomeapi.com.br/api-de-moedas](https://docs.awesomeapi.com.br/api-de-moedas).



<a id="tecnologias-utilizadas"></a>

## :rocket: Tecnologias Utilizadas

O projeto foi desenvolvido utilizando as seguintes tecnologias:

- [Docker](https://docker.com)
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
- [ReactJS](https://pt-br.reactjs.org/)
 
<a id="como-usar"></a>

# :construction_worker: Como Usar

### **Pré-requisitos**

  - É **necessário** possuir o **[Docker](https://docker.com)** instalado na máquina.
  - Também, é **essencial** ter o **[Docker Composer](https://docs.docker.com/compose/install/)** instalado de forma global na máquina.

```bash
# Clone o Repositório
$ git clone URL_DO REPOSITÓRIO.
```
### :whale: Executando os containers

```bash
# Entre na pasta projeto
$ cd NOME_DA_PASTA_DO_PROJETO

# Levantando os Containers
$ docker-compose up -d
```
```
# Para configurar o backend é necessario installar as bibliotecas então entre na pasta ./api/backend.
# e digite:
$ composer update
# Ou caso não tenho o PHP instalado localmente entrar no container php
# Entre no container com o comando 
$ docker exec -it php bash
# Sair da pasta public com:
$ cd ..
# E installar as bibliotecas com o comando:
$ composer update

```
```
# Para configurar o frontend é necessario ter o NodeJS instalado, entrar na pasta ./frontend.
# e digite:
$ npm install
```
---

<h4 align="center">
    Feito com ❤️ by <a href="https://www.linkedin.com/in/developer-danielmn/" target="_blank">Daniel Meireles</a>
</h4>