# Add PHP-FPM base image
FROM php:5.6-fpm
# Install your extensions
# To connect to MySQL add mysqli
#RUN docker-php-ext-install mysqli pdo pdo_mysql gd
RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql
