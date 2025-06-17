````markdown
# Desafio Desenvolvedor - API de Instrumentos Financeiros

![Python](https://img.shields.io/badge/Python-3.12%2B-blue.svg)
![FastAPI](https://img.shields.io/badge/FastAPI-0.110%2B-green.svg)
![Docker](https://img.shields.io/badge/Docker-25%2B-blue.svg)
![Redis](https://img.shields.io/badge/Redis-7%2B-red.svg)
![Pytest](https://img.shields.io/badge/Pytest-8%2B-brightgreen.svg)
![Status](https://img.shields.io/badge/status-concluído-brightgreen)

Este repositório contém a solução para o **Desafio de Desenvolvedor da Oliveira Trust**. O projeto consiste em uma API RESTful para processar, armazenar e consultar dados de instrumentos financeiros.

A aplicação foi desenvolvida em Python, utilizando o framework FastAPI, e estruturada com foco em **Clean Code** e **Clean Architecture**. O ambiente é totalmente containerizado com Docker, inclui um sistema de cache com Redis para otimização de performance e uma suíte de testes automatizados com Pytest para garantir a qualidade do código.

## ✨ Principais Funcionalidades

- **Upload de Arquivos:** Endpoint para receber arquivos (`.csv`, `.xlsx`) com prevenção de duplicatas.
- **Histórico de Uploads:** Endpoint para consultar os arquivos processados, com filtros por nome e data.
- **Busca de Instrumentos:** Endpoint robusto para consultar os dados, com filtros e paginação.
- **Cache de Consultas:** As buscas de instrumentos são cacheadas com Redis para respostas mais rápidas em requisições repetidas.
- **Testes Automatizados:** Suíte de testes unitários com `pytest` para garantir a confiabilidade da lógica de negócio.

## 🏛️ Arquitetura do Projeto

A aplicação segue os princípios da **Arquitetura Limpa (Clean Architecture)**, com responsabilidades divididas em camadas (`domain`, `application`, `infrastructure`) para garantir um código desacoplado, testável e de fácil manutenção.

## 🚀 Tecnologias Utilizadas

- **Linguagem:** Python 3.12+
- **Framework da API:** FastAPI
- **Processamento de Dados:** Pandas & OpenPyXL
- **Banco de Dados:** SQLite (via SQLAlchemy Core)
- **Cache:** Redis
- **Testes:** Pytest, Pytest-Mock, HTTPX
- **Containerização:** Docker & Docker Compose
- **Servidor ASGI:** Uvicorn

## 🚀 Como Executar

### Executando a Aplicação

A maneira mais recomendada de executar o projeto é com Docker, pois ele gerencia a aplicação e o serviço de Redis automaticamente.

**Pré-requisitos:**

- Docker
- Docker Compose

**Execução:**
Na raiz do projeto, execute o seguinte comando:

```bash
docker compose up --build
```
````

Isso irá construir as imagens e iniciar os contêineres da API e do Redis. A aplicação estará disponível em `http://127.0.0.1:8000`.

Para parar a aplicação, pressione `Ctrl + C` no terminal e depois execute `docker compose down`.

### Executando os Testes

**Opção 1: Com Docker (Recomendado)**
Com a aplicação rodando (`docker compose up`), abra um **segundo terminal** e execute:

```bash
docker compose exec api pytest
```

Este comando executa o `pytest` dentro do contêiner da `api` que já está em execução.

**Opção 2: Localmente**
Se você instalou as dependências localmente, basta ativar seu ambiente virtual e rodar:

```bash
# Ativar ambiente virtual (se não estiver ativo)
source venv/bin/activate

# Rodar os testes
pytest
```

## 📚 Documentação e Uso da API

A documentação interativa da API (Swagger UI) é gerada automaticamente e pode ser acessada em:

- **Swagger UI:** [http://127.0.0.1:8000/docs](https://www.google.com/search?q=http://127.0.0.1:8000/docs)

Nesta página, é possível visualizar todos os endpoints e testá-los diretamente pelo navegador.

Feito por **[Gabriell Maia do Amaral Duarte]**

- **LinkedIn:** [https://www.linkedin.com/in/biellmaaia/]
- **GitHub:** [https://github.com/maia2a]

<!-- end list -->

