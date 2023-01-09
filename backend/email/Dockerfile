FROM php:8.1-fpm

# set your user name
ARG user=www
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libc6-dev \
    libsasl2-dev \
    libsasl2-modules \
    libssl-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    iputils-ping \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

## Add xdebug
#RUN pecl install xdebug-3.1.5
#RUN docker-php-ext-enable xdebug
#RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.log_level=0" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.discover_client_host=0" >> /usr/local/etc/php/conf.d/xdebug.ini

# Set working directory
WORKDIR /var/www

COPY ./src .

COPY ./src/.env.example .env

RUN chown -R $user ./
USER $user
RUN composer install

ENV PHP_IDE_CONFIG="serverName=email_api"

EXPOSE 9000
