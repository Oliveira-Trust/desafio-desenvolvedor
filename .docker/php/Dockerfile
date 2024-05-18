FROM php:8.2-fpm

WORKDIR /var/www/html/app

# Install system dependencies including Nginx
RUN apt-get update && apt-get install -y \
    nginx \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    cron \
    supervisor \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Setup composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Import project and install dependencies
COPY . /var/www/html/app
RUN composer install --quiet --optimize-autoloader \
    && chown -R www-data:www-data /var/www/html/app \
    && chmod -R 775 /var/www/html/app/storage /var/www/html/app/bootstrap/cache \
    && chmod +x /var/www/html/app/entrypoint.sh

# Correct the cron job setup
RUN echo "* * * * * www-data cd /var/www/html/app && php artisan schedule:run >> /var/log/cron.log 2>&1" > /etc/cron.d/laravel-scheduler \
    && chmod 0644 /etc/cron.d/laravel-scheduler \
    && crontab -u www-data /etc/cron.d/laravel-scheduler

# Copy Supervisor configuration
COPY .docker/supervisord/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Ensure log directory exists for Supervisor, Laravel, and Nginx
RUN mkdir -p /var/log/supervisor /var/log/nginx && \
    touch /var/log/php-fpm.log /var/log/cron.log /var/log/laravel.log /var/log/laravel_worker.log && \
    chown -R www-data:www-data /var/log

# Copy your Nginx site configuration to replace the default
COPY .docker/nginx/default.conf /etc/nginx/sites-available/default

# Expose port 80 for Nginx
EXPOSE 80

# Start Supervisord
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
