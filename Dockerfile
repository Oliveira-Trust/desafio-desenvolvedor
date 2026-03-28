# syntax=docker/dockerfile:1.4
# =========================
# 1A. BASE CLI
# =========================
FROM serversideup/php:8.4-cli AS base-cli

USER root

RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libssl-dev \
        pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && pecl install mongodb redis \
    && docker-php-ext-enable mongodb redis \
    && apt-get purge -y --auto-remove libpng-dev libjpeg-dev libfreetype6-dev libssl-dev pkg-config \
    && apt-get install -y --no-install-recommends libpng16-16 libjpeg62-turbo libfreetype6 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# =========================
# 1B. BASE FPM
# =========================
FROM serversideup/php:8.4-fpm-nginx AS base-fpm

USER root

RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libssl-dev \
        pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && pecl install mongodb redis \
    && docker-php-ext-enable mongodb redis \
    && apt-get purge -y --auto-remove libpng-dev libjpeg-dev libfreetype6-dev libssl-dev pkg-config \
    && apt-get install -y --no-install-recommends libpng16-16 libjpeg62-turbo libfreetype6 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# =========================
# 2. BUILDER
# Compila assets JS e instala dependências PHP.
# =========================
FROM base-cli AS builder

USER root

# Instala Node.js 22 LTS
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN --mount=type=cache,target=/root/.composer/cache \
    composer install \
        --no-interaction \
        --no-scripts \
        --no-autoloader \
        --prefer-dist

COPY package.json package-lock.json ./
RUN --mount=type=cache,target=/root/.npm \
    npm ci

COPY . .
RUN composer dump-autoload --optimize \
    && composer run-script post-autoload-dump 2>/dev/null || true
RUN npm run build

# =========================
# 3A. APP (FPM + Nginx)
# =========================
FROM base-fpm AS app

WORKDIR /var/www/html

COPY --from=builder /var/www/html /var/www/html

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN docker-php-serversideup-set-id www-data ${USER_ID}:${GROUP_ID} \
    && docker-php-serversideup-set-file-permissions \
        --owner ${USER_ID}:${GROUP_ID} \
        --service nginx

USER www-data

# =========================
# 3B. QUEUE (Horizon)
# =========================
FROM base-cli AS queue

WORKDIR /var/www/html

COPY --from=builder /var/www/html /var/www/html

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN docker-php-serversideup-set-id www-data ${USER_ID}:${GROUP_ID} \
    && docker-php-serversideup-set-file-permissions \
        --owner ${USER_ID}:${GROUP_ID}

USER www-data

CMD ["php", "artisan", "horizon"]

# =========================
# 3C. SCHEDULER (Laravel scheduler)
# =========================
FROM base-cli AS scheduler

WORKDIR /var/www/html

COPY --from=builder /var/www/html /var/www/html

RUN chown -R www-data:www-data storage bootstrap/cache

USER www-data

CMD ["/bin/sh", "-c", "while true; do php artisan schedule:run --no-interaction; sleep 60; done"]
