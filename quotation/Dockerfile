FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    unzip \
    redis \
    r-base

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

# RUN chmod -R 755 storage/
# RUN chown www-data:www-data -R /var/www/storage
RUN adduser -D -H -u 1000 -s /bin/bash www-data -G www-data
RUN composer install
