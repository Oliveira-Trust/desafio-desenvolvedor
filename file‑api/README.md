# 📁 File Upload API (Laravel + SQLite)

Esta é uma API desenvolvida em **Laravel** que permite:

- 📤 Upload de arquivos CSV/Excel
- 🕓 Histórico de uploads
- 🔎 Busca de conteúdo com filtros (`TckrSymb`, `RptDt`)
- 💾 Banco de dados: **SQLite**

---

## ⚙️ Requisitos

- PHP 8.1+
- Composer
- Laravel 10 ou 11
- Extensões PHP: `pdo_sqlite`, `fileinfo`
- (Opcional) MongoDB Driver se utilizar `jenssegers/mongodb`

---

## 🚀 Instalação

```bash
# Clone o repositório
git clone https://github.com/seu-usuario/nome-do-projeto.git
cd nome-do-projeto

# Instale as dependências
composer install

# Crie o arquivo SQLite
touch database/database.sqlite

# Copie e configure o .env
cp .env.example .env
php artisan key:generate

# Defina as variáveis no .env
DB_CONNECTION=sqlite
DB_DATABASE=${DB_DATABASE_PATH}/database.sqlite

# Rode as migrations
php artisan migrate

# Inicie o servidor
php artisan serve
