<h2 align="center"><a href="https://ot.lucasfernandes.com.br/">👉 Disponível aqui 👈</a></h2>
<p align="center">Desenvolvido por <a href="https://github.com/PxLucasF">Lucas Fernandes</a> com <b>CodeIgniter 4</b> e <b>Svelte</b>.</a>

## Requisitos ✅
- [x] CRUD de clientes
- [x] CRUD de produtos
- [x] CRUD de pedidos
- [x] Cada CRUD:
  - [x] É filtrável e ordenável por qualquer campo;
  - [x] Possui formulários para criação e atualização de seus itens;
  - [x] Permitie a deleção de qualquer item de sua lista;
  - [x] Possui barra de navegação entre eles;
  - [x] Links para os outros CRUDs nas listagens.

## Bônus 🎁
- [x] Implementar autenticação de usuário na aplicação
- [ ] Permitir deleção em massa de itens nos CRUDs
- [x] Implementar a camada de Front-End utilizando a biblioteca javascript Bootstrap e ser responsiva
- [x] API Rest JSON para todos os CRUDS listados acima

## Tecnologias utilizadas 🧰
Back-end:
- [CodeIgniter 4](http://codeigniter.com/)
- [OAuth2 Server PHP](https://github.com/bshaffer/oauth2-server-php-docs)

Front-end:
- [Svelte](https://svelte.dev)
- [SvelteKit](https://kit.svelte.dev)
- [Bootstrap 5](https://github.com/bestguy/sveltestrap)
- [Sass](https://sass-lang.com/)

## Deploy 🚀
Esse projeto está disponível para demonstração [nesse link](http://lucasfernandes.com.br/projects/desafio-desenvolvedor). Caso você queira dar deploy na sua própria hospedagem, siga o passo-a-passo à seguir (considerando que você já tem o [Composer](https://getcomposer.org) e [NPM](https://nodejs.org/en) instalados):

Back-end:
1. Instale as dependências com `composer.phar install`
2. Renomeie o arquivo **"env"** para **".env"** e informe os dados do seu banco de dados
3. Execute [esse comando SQL](./backend/schema.sql) para configurar o schema do seu banco de dados
4. Execute [esse outro comando SQL](./backend/oauth_client.sql) para criar um cliente do OAuth
5. Sirva a pasta **"public"**

Front-end
1. Instale as dependências com `npm install`
2. Configure a URL (sem "/" no final) e credenciais do OAuth em **"src/utils.js"**
3. Execute `npm run build` para gerar a build
4. Sirva a pasta **"build"**