FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libjpeg-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libbz2-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    zip \
    unzip

# Install system dependencies
RUN pecl install mongodb redis \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongo.ini \
    && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install bz2 bcmath ctype fileinfo json mbstring pdo tokenizer xml pcntl

# Enable PHP extensions
RUN docker-php-ext-enable mongodb redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -d /home/laravel laravel
RUN mkdir -p /home/laravel/.composer && \
    chown -R laravel:laravel /home/laravel

# Install NodeJS and NPM
RUN curl -fsSL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs

# Set working directory
WORKDIR /var/www

USER laravel
