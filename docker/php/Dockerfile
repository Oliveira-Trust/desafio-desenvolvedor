FROM php:8.2-fpm

# Install necessary packages and PHP extensions
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy custom PHP configuration
COPY ./docker/php/custom-php.ini /usr/local/etc/php/conf.d/

# Set working directory
WORKDIR /var/www