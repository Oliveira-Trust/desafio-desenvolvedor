FROM php:8.2-fpm

WORKDIR /var/www/html/app

# Setup basic dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libonig-dev \
    curl \
    libxml2-dev \
    libpng-dev \
    zip \
    unzip \
    libzip-dev \
    git && \
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Setup php extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Setup redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Setup XDebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Setup composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Setup permissions
ARG USERNAME=dev
ARG UID=1000
ARG GID=1000

# Using Ubuntu's groupadd and useradd commands
RUN groupadd -g ${GID} ${USERNAME} && \
    useradd -u ${UID} -g ${GID} -s /bin/sh -m ${USERNAME}

USER ${USERNAME}

# Expose port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
