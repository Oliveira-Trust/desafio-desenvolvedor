FROM php:7.4.27-fpm-buster

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    pkg-config \
    librabbitmq-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd xml sockets
RUN pecl install redis && pecl install amqp
RUN docker-php-ext-enable redis amqp

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www/

COPY --chown=www:www . /var/www

USER www

EXPOSE 9000

CMD ["php-fpm"]
