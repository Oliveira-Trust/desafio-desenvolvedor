## Instalação

Siga os passos abaixo para configurar e executar o projeto:

1. Garanta que você possui um ambiente Docker Composer com WSL perfeitamente funcional.

2. Clone o projeto para uma pasta com o seguinte comando:
```bash
git clone https://github.com/cassiuslc/Users-Manager.git
```
3. Crie a rede docker do projeto
```bash
docker network create app-network
```
3. Acesse a pasta do projeto
```bash
cd Users-Manager
```
4. Acesse a pasta da seção do laravel (API)
```bash
cd api
```
4. Construa o conteiner docker do laravel e banco de dados
```bash
docker-compose up -d --build
```
5. Acesse o console do Docker PHP e instale as dependências e permissões.
```bash
docker-compose exec php bash
composer setup
chown -R www-data:www-data /var/www
exit
```
Neste momento você deve conseguir acessar o swagger da aplicação em http://localhost/api/documentation

6. Retorne a raiz do projeto e acesse a pasta web
```bash
cd ..
cd web
```
7. Inicie o conteiner docker da seção web do projeto
```bash
docker-compose up -d --build
```
Você deve ver o projeto na porta 8080 em http://localhost:8080/

Caso o banco apresente algum problema de permissão com docker tente reiniciar ele
```bash
docker restart api-db-1
```
### Para Iniciar o projeto outras vezes
Use o comando a baixo em cada pasta api e web
```bash
docker-compose up -d
```
## 🚀 Sobre mim

- [@cassiuslc](https://www.github.com/cassiuslc)

### A Oliveira Trust:
A Oliveira Trust é uma das maiores empresas do setor Financeiro com muito orgulho, desde 1991, realizamos as maiores transações do mercado de Títulos e Valores Mobiliários.

Somos uma empresa em que valorizamos o nosso colaborador em primeiro lugar, sempre! Alinhando isso com a nossa missão "Promover a satisfação dos nossos clientes e o desenvolvimento pessoal e profissional da nossa equipe", estamos construindo times excepcionais em Tecnologia, Comercial, Engenharia de Software, Produto, Financeiro, Jurídico e Data Science.

Estamos buscando uma pessoa que seja movida a desafios, que saiba trabalhar em equipe e queira revolucionar o mercado financeiro!

Front-end? Back-end? Full Stack? Analista de dados? Queremos conhecer gente boa, que goste de colocar a mão na massa, seja responsável e queira fazer história!

#### O que você precisa saber para entrar no nosso time: 🚀
- Trabalhar com frameworks (Laravel, Lumen, Yii, Cake, Symfony ou outros...)
- Banco de dados relacional (MySql, MariaDB)
- Trabalhar com microsserviços

#### O que seria legal você saber também: 🚀
- Conhecimento em banco de dados não relacional;
- Conhecimento em docker;
- Conhecimento nos serviços da AWS (RDS, DynamoDB, DocumentDB, Elasticsearch);
- Conhecimento em metodologias ágeis (Scrum/Kanban);

#### Ao entrar nessa jornada com o nosso time, você vai: 🚀
- Trabalhar em uma equipe de tecnologia, em um ambiente leve e descontraído e vivenciar a experiência de mudar o mercado financeiro;
- Dress code da forma que você se sentir mais confortável;
- Flexibilidade para home office e horários;
- Acesso a cursos patrocinados pela empresa;

#### Benefícios 🚀
- Salário compatível com o mercado;
- Vale Refeição;
- Vale Alimentação;
- Vale Transporte ou Vale Combustível;
- Plano de Saúde e Odontológico;
- Seguro de vida;
- PLR Semestral;
- Horário Flexível;
- Parcerias em farmácias

#### Local: 🚀
Barra da Tijuca, Rio de Janeiro, RJ

#### Conheça mais sobre nós! :sunglasses:
- Website (https://www.oliveiratrust.com.br/)
- LinkedIn (https://www.linkedin.com/company/oliveiratrust/)

A Oliveira Trust acredita na inclusão e na promoção da diversidade em todas as suas formas. Temos como valores o respeito e valorização das pessoas e combatemos qualquer tipo de discriminação. Incentivamos a todos que se identifiquem com o perfil e requisitos das vagas disponíveis que candidatem, sem qualquer distinção.

## Pronto para o desafio? 🚀🚀🚀🚀
https://github.com/Oliveira-Trust/desafio-desenvolvedor/blob/master/vaga.md
