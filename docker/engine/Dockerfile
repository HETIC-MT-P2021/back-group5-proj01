FROM php:7.4-fpm

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu

RUN apt-get update && \
    apt-get install -y zlib1g-dev libzip-dev

RUN docker-php-ext-install zip
RUN docker-php-ext-enable apcu

RUN apt-get update & \
    apt-get install -y curl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /usr/src/app

COPY . /usr/src/app

RUN composer install

RUN PATH=$PATH:/usr/src/apps/vendor/bin:bin