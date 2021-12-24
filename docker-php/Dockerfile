
FROM php:7.4-fpm

WORKDIR /usr/share/nginx

RUN apt-get update && \
    apt-get install libzip-dev -y && \
    docker-php-ext-install zip pdo_mysql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer