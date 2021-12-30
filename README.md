# PROJETO API BACKEND PHP FRONTEND REACTJSCONVERÇÃO DE MOEDAS#


---

Projeto desenvolvido com estrutura API REST no backend em PHP, Banco de dados MySQL, Frontend com ReactJS utilizando algumas bibliotecas PHP/JavaSCript.
Foi utilizado Docker e docker-compose para o desenvolvimento, e alguns conceitos DDD e TDD na arquitetura do projeto.


<p align="center">	
   <a href="https://www.linkedin.com/in/developer-danielmn/">
      <img alt="Daniel Meireles" src="https://img.shields.io/badge/-Daniel Meireles-0080000?style=flat&logo=Linkedin&logoColor=white" />
   </a>
</p>

# :pushpin: Índice

- [Sobre](#sobre)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Como Usar](#como-usar)


<a id="sobre"></a>

## :bookmark: Sobre

O <strong>Projeto Converção de moedas</strong> é um projeto desenvolvido consumindo a api: [https://docs.awesomeapi.com.br/api-de-moedas](https://docs.awesomeapi.com.br/api-de-moedas).Com backend em PHP frontend em ReactJS e usa o banco MySQL para armazenar os dados.

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

  - É **necessário** possuir o **[Docker](https://docker.com)** e **[Docker Composer](https://docs.docker.com/compose/install/)** instalado na máquina.
  - Também, é **necessário** ter o **[NodeJS](https://nodejs.org/en/)** instalado pois o frontend não rodara dentro de um container como o backend.

```bash
# Clone o Repositório
$ git clone URL_DO REPOSITÓRIO.
```
### :whale: Executando o Projeto

### Backend
```bash
# Entre na pasta projeto
$ cd NOME_DA_PASTA_DO_PROJETO
# Entrar na pasta do backend 'api/backend' e copiar o arquivo .env.exemple renomeando para .env
# Ele ja possui as configuraçẽos necessarias para rodar o projeto, apois copiar voltar para a pasta raiz do projeto onde esta o arquivo docker-compose.yml.
$ cd NOME_DA_PASTA_DO_PROJETO
```
```bash
# Levantando os Containers. 
# A imagem php-apache construida para o projeto já esta pronta para rodar as migrations e manter o apache funcionando.
$ docker-compose up -d --build
```
### Frontend
```bash
# Para configurar o frontend é necessario ter o NodeJS instalado, entrar na pasta ./frontend.
# Instalar as biblitecas necessarias com o comando:
$ npm install
```
```bash
# Apos instalar as biblitecas digite o comando:
$ npm start
```
---

<h4 align="center">
    Feito com ❤️ by <a href="https://www.linkedin.com/in/developer-danielmn/" target="_blank">Daniel Meireles</a>
</h4>