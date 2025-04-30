FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    librabbitmq-dev \
    libssl-dev \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip

# Install MongoDB extension
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Install AMQP extension for RabbitMQ
RUN pecl install amqp && docker-php-ext-enable amqp

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Configure PHP
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Create Laravel project if it doesn't exist
RUN if [ ! -d "/var/www/html/app" ]; then \
        composer create-project --prefer-dist laravel/laravel:^9.0 . --no-interaction; \
    fi

# Ensure directory permissions are correct
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]