FROM php:8.1-fpm

# Installation des extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Configuration PHP
RUN echo "error_reporting = E_ALL" > /usr/local/etc/php/conf.d/docker-php-error-reporting.ini \
    && echo "display_errors = On" > /usr/local/etc/php/conf.d/docker-php-display-errors.ini

WORKDIR /app