FROM docker.io/bitnami/laravel:9

# RUN apt install --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS \ 
#  libzip-dev libxml2-dev curl-dev linux-headers oniguruma-dev imap-dev libpng-dev openssl-dev

# Xdebug <3
RUN apt-get update && apt-get -y install autoconf &&  apt-get -y install build-essential
RUN pecl channel-update pecl.php.net
RUN pecl install xdebug 
# \
    # && docker-php-ext-enable xdebug

COPY ./docker/config/xdebug.ini /etc/php.d/xdebug.ini

WORKDIR /app
# LOGS <3
RUN echo "alias logs='tail -f /app/storage/logs/*log' " >> /root/.bashrc

EXPOSE 80 443

# RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.idekey=VSCODE" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.log=/var/www/html/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && touch /var/www/html/xdebug.log \
#     && chown developer:www-data /var/www/html/xdebug.log \
#     && chmod 775 /var/www/html/xdebug.log
