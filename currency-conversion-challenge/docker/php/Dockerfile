FROM php:8.3-fpm-alpine3.19

# Install system dependencies
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libzip-dev \
    libpq-dev \
    zlib-dev \
    oniguruma-dev

# Install PHP extensions
RUN docker-php-ext-install gd
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-install mbstring

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

EXPOSE 9000