FROM php:7.4-apache

RUN pecl install xdebug-2.9.6
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install pdo pdo_mysql
