# Add PHP-FPM base image
FROM php:5.6-fpm
# Install your extensions
# To connect to MySQL add mysqli
RUN docker-php-ext-install mysqli pdo pdo_mysql


# https://github.com/mlocati/docker-php-extension-installer
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# https://docs.typo3.org/m/typo3/tutorial-getting-started/main/en-us/SystemRequirements/Index.html

RUN install-php-extensions gd zip tokenizer intl openssl
