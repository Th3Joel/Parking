FROM php:8.3-apache

RUN apt-get update && apt-get install -y zlib1g-dev libpng-dev
RUN a2enmod rewrite

COPY . /var/www/html/
COPY php.ini /usr/local/etc/php/
RUN rm *.yaml Dockerfile *.ini

RUN chown -R www-data:www-data /var/www/html

RUN docker-php-ext-install pdo_mysql pdo gd 

EXPOSE 9090
CMD ["apache2-foreground"]