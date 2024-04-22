# Add PHP-FPM base image
FROM php:5.6-fpm
# Install your extensions
# To connect to MySQL add mysqli
RUN docker-php-ext-install mysqli pdo pdo_mysql



# checkout https://stackoverflow.com/questions/39657058/installing-gd-in-docker
RUN apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev RUN docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir \
  --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir \
  --enable-gd-native-ttf RUN docker-php-ext-install gd
