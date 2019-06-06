FROM php:7.3-fpm

RUN docker-php-ext-install pdo pdo_mysql && \

    pecl install xdebug && \
    docker-php-ext-enable xdebug

COPY ./xdebug.ini $PHP_INI_DIR/conf.d/
