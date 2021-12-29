FROM php:7.4-cli

WORKDIR /usr/share/nginx

RUN apt-get update && \
    apt-get install -y wget && \
    apt-get install libzip-dev -y && \
    docker-php-ext-install zip pdo pdo_mysql && \
    chown -R www-data:www-data /usr/share/nginx && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

EXPOSE 9000
