FROM php:8.4-apache

# Install dependencies
RUN apt-get update -y && \
    apt-get upgrade -y && \
    apt-get install -y \
    zip unzip

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Project files
WORKDIR /var/www
COPY ./api/composer.json /var/www/composer.json

RUN composer install --ignore-platform-reqs

# .env file
COPY ./etc/config/.env /var/www/.env
