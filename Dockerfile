FROM php:8.2-apache
COPY php.ini /usr/local/etc/php/php.ini
RUN docker-php-ext-install mysqli
