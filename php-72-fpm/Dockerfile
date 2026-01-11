# Add PHP-FPM base image
FROM php:7.2-fpm

# Copy php.ini and php-fpm.conf
COPY ./php-72-fpm/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY ./php-72-fpm/php.ini /usr/local/etc/php/php.ini

# Fix Debian Buster EOL repositories
RUN sed -i 's/deb.debian.org/archive.debian.org/g' /etc/apt/sources.list && \
    sed -i 's/security.debian.org/archive.debian.org/g' /etc/apt/sources.list && \
    sed -i '/buster-updates/d' /etc/apt/sources.list

# Install system dependencies (allow unauthenticated due to expired EOL keys)
RUN apt-get update && apt-get install -y --allow-unauthenticated \
    graphicsmagick \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    libcurl4-openssl-dev \
    && rm -rf /var/lib/apt/lists/*

# Install MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# https://github.com/mlocati/docker-php-extension-installer
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# TYPO3 7.x/8.x/9.x required and recommended extensions
# https://docs.typo3.org/m/typo3/tutorial-getting-started/main/en-us/SystemRequirements/Index.html
RUN install-php-extensions \
    # Required
    gd \
    xml \
    zip \
    zlib \
    mbstring \
    fileinfo \
    intl \
    filter \
    # Recommended for performance
    opcache \
    apcu \
    # Useful for TYPO3
    curl \
    json \
    soap \
    ctype \
    session \
    hash \
    pcre \
    simplexml \
    tokenizer \
    exif \
    # Additional for newer TYPO3
    pdo
