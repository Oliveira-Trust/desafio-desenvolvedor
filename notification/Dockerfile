FROM php:8.1

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libevent-dev\
    libssl-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    unzip \
    redis \
    r-base

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install sockets pcntl

RUN pecl install event

RUN docker-php-ext-enable --ini-name zz-event.ini event

COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

COPY . /var/www
WORKDIR /var/www

RUN composer install
