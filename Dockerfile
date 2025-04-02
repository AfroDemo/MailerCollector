FROM php:8.2-fpm

# Install dependencies and MySQL client
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && docker-php-ext-enable mysqli

WORKDIR /var/www/html