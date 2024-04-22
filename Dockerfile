# Add PHP-FPM base image
FROM php:5.6-fpm
# Install your extensions
# To connect to MySQL add mysqli
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update -y && apt-get install -y sendmail libpng-dev

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev

RUN docker-php-ext-install mbstring

RUN docker-php-ext-install zip

RUN docker-php-ext-install gd
