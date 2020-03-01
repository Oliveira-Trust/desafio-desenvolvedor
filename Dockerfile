FROM php:7.2-fpm-stretch

MAINTAINER Heric Branco <hericbranco@gmail.com>

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
#Instaling my-sql driver
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libpq-dev libldap2-dev mysql-client zip git wget build-essential nodejs\
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql

RUN docker-php-ext-install pcntl

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

#Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

#Create a new directory to run our app.
RUN mkdir -p /var/www/html/

#Set the new directory as our working directory
WORKDIR /var/www/html/

#Copy all the content to the working directory
COPY . /var/www/html/

#Install composer dependecies
RUN composer install --no-dev
RUN chmod -R 777 /var/www/html/storage
RUN chmod 777 /var/www/html/start_server

RUN cd /var/www/html/ &&  php artisan vendor:publish --provider="Laravel\Horizon\HorizonServiceProvider"

#Our app runs on port 9000. Expose it!
EXPOSE 9000

#Run the application.
CMD ["/var/www/html/start_server"]
