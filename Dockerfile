FROM php:8.1-apache

RUN apt-get update

RUN apt-get install -yqq libzip-dev
RUN docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer