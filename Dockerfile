FROM php:8.2-apache
COPY php.ini /usr/local/etc/php/php.ini
RUN docker-php-ext-install mysqli
RUN sed -i 's/ServerTokens OS/ServerTokens Prod/g' /etc/apache2/conf-available/security.conf
RUN a2enmod headers \
    && echo '<IfModule mod_headers.c>\n    Header always set X-Content-Type-Options "nosniff"\n</IfModule>' > /etc/apache2/conf-available/my-apache-config.conf \
    && a2enconf my-apache-config
RUN service apache2 restart
