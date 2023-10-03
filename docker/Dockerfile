FROM php:8.2-fpm-alpine

# Install usermod and usermod www-data
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk update
RUN apk add --no-cache shadow
RUN usermod -u 1000 www-data

# Install PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Install PCOV
RUN apk add --no-cache autoconf build-base
RUN pecl install pcov && docker-php-ext-enable pcov

# Install opcache
RUN docker-php-ext-install opcache

# Install composer (updated via entry point)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install wkhtmltopdf
RUN echo 'https://dl-cdn.alpinelinux.org/alpine/v3.14/community' >> /etc/apk/repositories
RUN echo 'https://dl-cdn.alpinelinux.org/alpine/v3.14/main' >> /etc/apk/repositories
RUN apk add --no-cache wkhtmltopdf xvfb ttf-dejavu ttf-droid ttf-freefont ttf-liberation
RUN ln -s /usr/bin/wkhtmltopdf /usr/local/bin/wkhtmltopdf
RUN chmod +x /usr/local/bin/wkhtmltopdf

# Install sockets (using workaround because of docker-php-ext-install issue)
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions
RUN install-php-extensions sockets

# Install intl extension
RUN apk add icu-dev
RUN docker-php-ext-install intl

# Install GD
RUN apk add --no-cache freetype-dev libjpeg-turbo-dev libpng-dev zlib-dev libwebp-dev
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install gd

# Install ZIP
RUN apk add --no-cache libzip-dev
RUN docker-php-ext-install zip

# Custom PHP settings
ADD ./docker/zzzz-config.ini /usr/local/etc/php/conf.d/zzzz-config.ini

# Install some global packages
RUN apk add --no-cache bash git jq moreutils openssh rsync yq

# Install Blackfire PHP Probe
RUN version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
    && architecture=$(uname -m) \
    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/alpine/$architecture/$version \
    && mkdir -p /tmp/blackfire \
    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp/blackfire \
    && mv /tmp/blackfire/blackfire-*.so $(php -r "echo ini_get ('extension_dir');")/blackfire.so \
    && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8307\n" > $PHP_INI_DIR/conf.d/blackfire.ini \
    && rm -rf /tmp/blackfire /tmp/blackfire-probe.tar.gz

# Add bash configuration
ADD ./docker/.bashrc /home/www-data/.bashrc
RUN chmod 777 /home/www-data/.bashrc

# Add localhost SSL certificates
ADD ssl /etc/ssl

# Add entrypoint
ADD ./docker/entrypoint.sh /home/root/entrypoint.sh
RUN chmod 777 /home/root/entrypoint.sh

WORKDIR /var/www/html

RUN chown -R 1000 /var/www

USER www-data

ENTRYPOINT /home/root/entrypoint.sh