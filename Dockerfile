FROM php:7.4-apache

RUN apt-get update && apt-get install -y zlib1g-dev libpng-dev
RUN a2enmod rewrite

#COPY . /var/www/html/

#RUN rm *.sql *.yaml Dockerfile

RUN chown -R www-data:www-data /var/www/html

RUN docker-php-ext-install pdo_mysql pdo gd 

EXPOSE 8080
CMD ["apache2-foreground"]