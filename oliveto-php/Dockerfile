FROM php:8.2-apache

RUN set -eux;
RUN apt-get update && apt-get install -y --no-install-recommends libfreetype6-dev libjpeg-dev libpng-dev libpq-dev libzip-dev libwebp-dev
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install gd
RUN docker-php-ext-install opcache
RUN docker-php-ext-install -j "$(nproc)" mysqli
RUN a2enmod rewrite;