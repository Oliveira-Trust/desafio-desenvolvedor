FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libssl-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    nano \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip

RUN pecl install redis \
    && docker-php-ext-enable redis

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php

RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y \
    nodejs \
    npm

WORKDIR /var/www/

COPY . .

RUN chown -R www-data:www-data /var/www/ && \
    chmod -R 755 /var/www/storage && \
    chmod -R 775 /var/www/bootstrap/cache

RUN npm install && \
    npm run build && \
    composer install

# Aumenta limite de upload do PHP
RUN echo "upload_max_filesize=100M\npost_max_size=100M" > /usr/local/etc/php/conf.d/uploads.ini
RUN echo "memory_limit=512M" > /usr/local/etc/php/conf.d/memory-limit.ini

EXPOSE 9000

CMD ["php-fpm"]