FROM php:7.1-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        wget \
        zip \
        unzip \
        libzip-dev \
        libxml2-dev \
        libpq-dev \
        libssh-dev \
    && docker-php-ext-install \
        pdo_mysql \
        zip \
        soap \
        bcmath 

RUN usermod -u 1000 www-data

RUN mkdir -pv /var/www/symfony-test/storage \
    && chown -R www-data:www-data /var/www/symfony-test/storage \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

WORKDIR "/var/www/symfony-test"