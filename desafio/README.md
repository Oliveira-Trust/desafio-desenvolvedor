## Requisitos de Instalação

- PHP: ^8.1
- Laravel Framework: ^10.0
- Composer v2

## Passo a Passo para Configuração

### 1. Instalar Dependências

Execute o seguinte comando para instalar as dependências do projeto:

```bash
composer install
```

### 2. Configurar o Ambiente

Copie o arquivo `.env.example` para `.env`:

```bash
cp .env.example .env
```

### 3. Configurar Banco de Dados

Crie um banco de dados e adicione as configurações de conexão no arquivo `.env`. As configurações básicas incluem:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

## Como Rodar o Projeto

### 1. Executar Migrações

Para criar as tabelas no banco de dados, execute:

```bash
php artisan migrate
```

### 2. Executar Seeders

Para popular o banco de dados com dados iniciais, execute:

```bash
php artisan db:seed
```

### 2. Executar node

Necessario execultar o node para build no node
```bash
npm run dev
```

### 3. Iniciar o Servidor

Para iniciar o servidor de desenvolvimento, execute:

```bash
php artisan serve
```

O projeto estará disponível em `http://localhost:8000`.

### 3. Logins
```bash
Email = admin@admin.com
Senha = admin
```

---
