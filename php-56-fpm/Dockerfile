# Add PHP-FPM base image
FROM php:5.6-fpm
# Install your extensions
# To connect to MySQL add mysqli
RUN docker-php-ext-install mysqli pdo pdo_mysql mysql


# https://github.com/mlocati/docker-php-extension-installer
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# https://docs.typo3.org/m/typo3/tutorial-getting-started/main/en-us/SystemRequirements/Index.html

# filter spl standard mbstring fileinfo zlib
RUN install-php-extensions xml gd zip tokenizer intl openssl filter spl standard mbstring fileinfo zlib

RUN apt-get update \
  && apt install -y graphicsmagick

#RUN apt-get update \
#    && apt-get install -y software-properties-common \
#    && apt-get update \
#    && add-apt-repository ppa:ondrej/php \
#    && apt-get update \
#    && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends tzdata \
#    && apt-get install -y php5.6-mbstring php5.6-mcrypt php5.6-mysql php5.6-xml \
#    && rm -rf /var/lib/apt/lists/*
