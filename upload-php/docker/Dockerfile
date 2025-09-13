FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev libcurl4-openssl-dev \
    libssl-dev pkg-config libicu-dev libpq-dev libjpeg-dev libfreetype6-dev supervisor

RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

RUN pecl install mongodb redis \
    && docker-php-ext-enable mongodb redis

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

COPY .env.example .env

RUN php artisan key:generate

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chown -R www-data:www-data /var/www

RUN sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

COPY docker/upload.ini /usr/local/etc/php/conf.d/upload.ini

COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]