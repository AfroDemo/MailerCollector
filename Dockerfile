FROM php:8.2-fpm

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

WORKDIR /var/www/html