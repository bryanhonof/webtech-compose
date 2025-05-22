FROM php:8-fpm-alpine

WORKDIR /var/www/html

RUN apk upgrade --update
RUN apk add \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libpq-dev \
        postgresql-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install pdo pdo_pgsql pgsql
