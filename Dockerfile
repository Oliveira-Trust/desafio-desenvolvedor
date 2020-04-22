# Dockerfile
FROM php:7.4-apache

# Labels
LABEL maintainer="Newton Gonzaga Costa<ncosta@proadv.com>" \      
  description="Imagem padrao para desenvolvimento web baseado em apache"

# Volume
VOLUME [ "/var/www/html" ]

# Workdir
WORKDIR /var/www/html/api

# Basic packages
RUN apt-get update && apt-get install -y --no-install-recommends \
    vim \
    curl \
    && rm -rf /var/lib/apt/lists/*

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions deps
RUN apt-get update && apt-get install --no-install-recommends -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    zlib1g-dev \
    libicu-dev \
    libxml2-dev \
    libaio-dev \
    libmemcached-dev \
    libssl-dev \
    openssl \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    libcurl4-openssl-dev \
    pkg-config
    # libsslcommon2-dev

# RUN docker-php-ext-configure zip

# Php extensions
RUN docker-php-ext-install \
    zip \
    gd \
    pdo_mysql \
    mbstring

# Installing Locales
RUN apt-get update && apt-get install -y locales 
RUN sed -i -- 's/# pt_BR/pt_BR/g' /etc/locale.gen
RUN locale-gen 

ENV LC_ALL pt_BR.UTF-8

#
#COPY php.ini /usr/local/etc/php

# Apache configuration
COPY assets/conf/000-default.conf /etc/apache2/sites-available

# RUN echo "Listen 80\nServerName localhost" >> /etc/apache2/apache2.conf

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash - \
  && apt-get update && apt-get install -y nodejs \ 
  && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

# Expose the default port
EXPOSE 80