![CI - TrustFlow](https://github.com/thiagodevmaster/desafio-desenvolvedor/actions/workflows/main.yml/badge.svg)

# TrustFlow - B3 Instrument Processor

O **TrustFlow** é uma API de alta performance desenvolvida em **Laravel 11** para o processamento, armazenamento e consulta de arquivos de instrumentos financeiros da B3. O projeto foi desenhado para resolver o desafio técnico da **Oliveira Trust**, focando em escalabilidade, processamento assíncrono e integridade de dados.

## Diferenciais do Projeto
- **Arquitetura Escalável:** Uso de *Service Pattern* para desacoplar a lógica de negócio dos Controllers.
- **Processamento em Chunks:** Capaz de processar arquivos de 400.000+ linhas sem estourar o limite de memória.
- **Documentação:** Integração com **Scribe** (OpenAPI/Swagger).
- **Testes:** Cobertura de testes utilizando **PHPUnit**.
- **Camada de Cache:** Estratégia de *Cache Tags* com Redis para garantir consultas sem sobrecarregar o banco de dados.

---

## Stack Utilizada
- **Backend:** PHP 8.5.3 + Laravel 13.1
- **Cache/Queue:** Redis
- **Database:** MySQL 8.4
- **Ambiente:** Docker (Laravel Sail)
- **Documentação:** Scribe
- **Testes:** PHPUnit

---

## Desafios e Resoluções Técnico-Arquiteturais

### 1. Manipulação de Grandes Volumes
* **Problema:** Processar 400k registros na carga inicial e mais arquivos diários com uma média de 75k de linhas via requisição HTTP causaria *timeout* e erro de memória.
* **Solução:** Implementei uma esteira de processamento assíncrono utilizando **Job Chaining**. O arquivo é validado de forma assíncrona (check de data e hash para evitar duplicidade de arquivo e data diferente da referência do arquivo), salvo no Storage, e então uma fila (Queue) assume o processamento pesado em background.
Ao final é enviado um email informando falha ou sucesso.

### 2. Otimização de Consultas e Consistência
* **Problema:** Consultas com filtros `LIKE` em milhões de linhas degradam a performance.
* **Solução:** Implementei **Cache Tags** (`instruments_data`). O cache é invalidado após um determinado temou ou quando um novo processamento de sucesso é concluído, garantindo que a performance da listagem seja mantida sem exibir dados obsoletos.

### 3. Segurança e Validação
* **Problema:** Evitar o processamento de arquivos corrompidos ou com datas divergentes.
* **Solução:** O `InstrumentsService` lê o *header* do arquivo em tempo real durante o upload para validar se a `RptDt` interna coincide com a informada no parâmetro, disparando um `422 Unprocessable Entity` antes mesmo de iniciar o Job.

---
## Possíveis Melhorias Futuras

* **Arquitetura distribuída:** Considerando que o o projeto inicia com 400k de linhas e mais 75k em média de linhas todos os dias durante uns 10 anos. Teremos um banco com uma certa sobrecarga em um cenário onde teremos 1 inserção para 1000 consultas/dia por exemplo. Neste caso poderíamos trabalhar com uma arquitetura distribuída onde teríamos um banco apenas para escrita e suas réplicas apenas para leitura, garantindo integridade e disponibilidade dos dados.


* **Utilização de habilities:** Aqui seria feito a implementação de permissões utilizando o `habilities do sanctum` onde seria definido quais usuários podem realizar um upload de arquivo e quais podem consultar. 

---

## 🚀 Como Executar o Projeto

### Pré-requisitos
- Docker & Docker Compose instalado.
- wsl.
- IDE (recomendável -> VScode / PHPStorm).

### Passo a Passo
1. **Clone o repositório:**
   ```bash
   git clone https://github.com/thiagodevmaster/desafio-desenvolvedor.git
   cd trustflow
   ```

1. **Instalar dependências (Bootstrapping via Docker):**
   Este comando utiliza uma imagem temporária do PHP 8.5 para baixar o Composer e criar a pasta `vendor`, necessária para habilitar o Laravel Sail.
   ```bash
   docker run --rm \
       -u "$(id -u):$(id -g)" \
       -v "$(pwd):/var/www/html" \
       -w /var/www/html \
       laravelsail/php85-composer:latest \
       composer install --ignore-platform-reqs

1. **Para otimizar seu tempo e trocar o uso de ./vendor/bin/sail para sail, rode o comando abaixo (opcional):**
   ```bash
   alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
   ```


1. **Prepare o sistema**
   ```bash
    cp .env.example .env

    <!-- Subir os containers -->
    sail up -d

    <!-- Executar migrações e seeders -->
    sail artisan migrate --seed

    <!--  Gerar documentação da API -->
    sail artisan scribe:generate

    <!-- Executar testes -->
    sail test
##

## ⚙️ Configuração do Ambiente

### 1. Arquivo .env
Antes de subir os containers, você deve configurar as variáveis de ambiente. O projeto já traz um `.env.example` preparado para o Docker Sail. 

**Passo a passo:**
1. Copie o arquivo de exemplo: `cp .env.example .env`
2. Atente-se às credenciais de e-mail. Para agilizar, recomendo fortemente a utilização do **Mailtrap** para verificar de forma simples o envio de e-mails em: [https://mailtrap.io](https://mailtrap.io).
3. Após configurar as chaves de SMTP do Mailtrap no `.env`, siga para a subida dos containers.

### 2. Gerenciador de Banco de Dados (GUI)
Para visualizar os usuários criados via *Seeders* ou auditar os instrumentos processados, você precisará conectar um gerenciador (DBeaver, TablePlus, HeidiSQL, etc.).

**Dados de conexão (Localhost):**
- **Host:** `127.0.0.1`
- **Porta:** `3307`
- **Usuário:** `sail`
- **Senha:** `password`
- **Database:** `laravel`


##
## 📝 Observações

- **Documentação da API:**  
Após subir o ambiente, a documentação gerada pelo Scribe pode ser acessada em: [http://localhost/docs](http://localhost/docs)

- **Logs dos testes:**  
  Os logs gerados durante a execução dos testes ficam disponíveis em:  ./build/report.txt

   **Arquivos de upload:**  
Todos os arquivos enviados para processamento são armazenados em:  ./storage/app/private/uploads

*(o caminho pode variar conforme a configuração de filesystem no `.env`)*

- **Collection do Postman:**  
Na raiz do projeto existe o arquivo: `DESAFIO.postman_collection.json` Ele pode ser importado diretamente no **Postman** para facilitar a execução e validação dos endpoints da API.


Para dúvidas, feedbacks ou agendamento de entrevistas, sinta-se à vontade para entrar em contato através dos canais abaixo:

* **Nome:** Thiago Dantas
* **E-mail:** thiagodantas.dev@gmail.com
* **Telefone:** (21) 9 8113-2269
* **LinkedIn:** [https://www.linkedin.com/in/thiago-dantas-dev/](https://www.linkedin.com/in/thiago-dantas-dev/)
* **GitHub:** [https://github.com/thiagodevmaster](https://github.com/thiagodevmaster)
* **Localidade:** Rio de Janeiro, RJ

---
**Desafio desenvolvido para o processo seletivo da Oliveira Trust.** 🚀