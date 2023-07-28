# Use uma imagem base apropriada para a sua aplicação (por exemplo, php:8.0-fpm)
FROM php:8.0-fpm

# Instalar as dependências necessárias para o Nginx e PHP
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    default-mysql-client \
    && apt-get clean

# Instalar extensões do PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

RUN apt-get update && apt-get install -y netcat

# Copiar a configuração do Nginx para dentro do contêiner
COPY ./docker/nginx/default.conf /etc/nginx/sites-available/default
# COPY ./docker/entrypoint.sh /entrypoint.sh
COPY ./entrypoint.sh /entrypoint.sh

#RUN chmod +x /entrypoint.sh

# Copiar a aplicação para dentro do contêiner
COPY . /var/www/html

# Dar permissão de execução ao entrypoint.sh
RUN chmod +x /entrypoint.sh

# Configurar o ponto de entrada para iniciar o Nginx e o PHP-FPM
CMD service nginx start && php-fpm

# Definir a porta em que o contêiner estará escutando
EXPOSE 80
