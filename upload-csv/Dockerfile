# Use a base image oficial do PHP com FPM
FROM php:8.2-fpm

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim unzip git curl libzip-dev \
    libonig-dev \
    pkg-config \
    libssl-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    supervisor \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar a extensão MongoDB (se for usar MongoDB)
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Instalar extensões PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar os arquivos do projeto para o contêiner
COPY . /var/www/html

# Instalar dependências do Laravel
RUN composer install --optimize-autoloader --no-dev

# Definir permissões corretas
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Otimizar a configuração do Laravel
RUN php artisan config:cache \
    && php artisan route:cache

# Expor a porta do PHP-FPM
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]
