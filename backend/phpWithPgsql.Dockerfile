FROM php:7.4-fpm-alpine

RUN apk upgrade --update && apk add \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libpq-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd pgsql
