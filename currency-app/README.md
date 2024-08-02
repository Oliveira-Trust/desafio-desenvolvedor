# Backoffice Banco do Brasil (v0.1.2)

**Versão: 0.1.2**

Este é o projeto da aplicação Backoffice do Banco do Brasil, desenvolvido com Vue 3, Vuetify, Pinia, e outras tecnologias modernas.

## Índice

- [Backoffice Banco do Brasil (v0.1.2)](#backoffice-banco-do-brasil-v012)
  - [Índice](#índice)
  - [Descrição](#descrição)
  - [Tecnologias Utilizadas](#tecnologias-utilizadas)
  - [Instalação](#instalação)
  - [Publicação](#publicação)

## Descrição

A aplicação Backoffice do Banco do Brasil é uma ferramenta interna para gestão de processos e dados bancários. A aplicação permite o gerenciamento eficiente de diversas operações administrativas e financeiras, facilitando o trabalho dos funcionários do banco.

## Tecnologias Utilizadas

- [Vue 3](https://vuejs.org/)
- [Vuetify](https://vuetifyjs.com/)
- [Pinia](https://pinia.vuejs.org/)
- [Vue Router](https://router.vuejs.org/)

## Instalação

Para instalar e executar a aplicação localmente, siga os passos abaixo:

1. Clone o repositório:
    ```bash
    git clone git@gitlab.nelogica.com.br:projetos-institucionais/bb-backoffice.git
    ```

2. Navegue até o local do projeto:
    ```bash
    cd bb-backoffice
    ```

3. Instale as dependências:
    ```bash
    npm install
    ```

4. Execute a aplicação:
    ```bash
    npm run dev
    ```

5. Acesse http://localhost:8080

## Publicação

Para gerar um novo pacote, basta executar o comando:

```bash
npm run build:production # Ambiente de produção
npm run build:homolog # Ambiente de produção
npm run build:development # Ambiente de desenvolvimento
npm run build # Alias para npm run build:development
```

O pacote será gerado no diretório ```./src/public/```.
