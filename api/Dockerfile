FROM php:7.4-apache

WORKDIR /var/www/html

RUN rm -r /etc/apache2/sites-available/000-default.conf
COPY ./backend.conf /etc/apache2/sites-available/
COPY ./entrypoint.sh  /

RUN ln -s /etc/apache2/sites-available/backend.conf /etc/apache2/sites-enabled/ && \
    ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y wget && \
    apt-get install libzip-dev -y && \
    apt-get install -y libicu-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-install zip intl pdo pdo_mysql && \
    chown -R www-data:www-data /var/www && \
    a2enmod headers

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

RUN usermod -u 1000 www-data

USER www-data

EXPOSE 80

ENTRYPOINT [ "sh", "/entrypoint.sh" ]