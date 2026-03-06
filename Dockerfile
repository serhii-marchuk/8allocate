FROM composer:2 AS composer

FROM php:8.4-fpm-alpine

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        icu-dev \
        oniguruma-dev \
        libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        mysqli \
        pdo \
        pdo_mysql \
        gd \
        intl \
        mbstring \
        xml

WORKDIR /var/www/html

COPY . /var/www/html