FROM php:7.4-fpm-alpine

RUN apk add --no-cache \
    git \
    zip \
    unzip \
    libzip-dev \
    libpng \
    libpng-dev

RUN docker-php-ext-install \
    zip\
    gd \
    pdo_mysql

RUN apk del libpng-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/yii2-library