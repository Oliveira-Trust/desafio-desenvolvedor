FROM celinederoland/php8.1-apache

ENV APP_ENV=${APP_ENV}
ENV APP_DEBUG=${APP_DEBUG}
ENV APP_URL=${APP_URL}
ENV DATABASE_DRIVER=${DATABASE_DRIVER}
ENV DATABASE_HOST=${DATABASE_HOST}
ENV DATABASE_PORT=${DATABASE_PORT}
ENV DATABASE_NAME=${DATABASE_NAME}
ENV DATABASE_USER=${DATABASE_USER}
ENV DATABASE_PASSWORD=${DATABASE_PASSWORD}
ENV TZ=America/Sao_Paulo

RUN set -eux && \
    apt-get update && \
    apt-get install -y wget unzip libxslt-dev libldap2-dev libmcrypt-dev libpq-dev libxml2-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libtidy-dev zlib1g-dev libzip-dev zip && \
    pecl install xdebug-2.9.8 apcu && \
    pecl install timezonedb && \
    a2enmod rewrite && \
    docker-php-ext-enable timezonedb && \
    docker-php-ext-configure gd --with-jpeg --with-freetype --with-jpeg && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) iconv gd intl pdo_pgsql pgsql soap zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 	&& HASH="$(wget -q -O - https://composer.github.io/installer.sig)" \
 	&& php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
 	&& php composer-setup.php --install-dir=/usr/local/bin --filename=composer

ADD ./ /var/www/html/api
ADD ./docker/php_config/php-extras.ini /usr/local/etc/php/conf.d/php-extras.ini
ADD ./docker/apache_config/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN set -eux && \
    cd /var/www/html/api && \
    mkdir -p /var/www/html/api/var/cache && \
    chown www-data:www-data -R /var/www/html/api && \
    chmod 777 -R var/cache && \
    composer clearcache && \
    chmod 777 -R storage/logs && \
    composer install --no-dev --optimize-autoloader --no-interaction --no-scripts && \
    composer dump-autoload && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
    echo $TZ > /etc/timezone && \
    mv .env.example .env

WORKDIR /var/www/html/api

#RUN php artisan key:generate

EXPOSE 80 9000 2525

CMD ["apache2-foreground"]




