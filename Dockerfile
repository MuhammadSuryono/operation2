FROM php:5.3-apache
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite
COPY myweb /var/www/html/myweb
