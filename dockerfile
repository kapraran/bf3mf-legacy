FROM php:8-apache
RUN a2enmod rewrite
RUN apt-get update
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
COPY . /var/www/html/
# RUN apt-get install -y software-properties-common
# RUN add-apt-repository ppa:ondrej/php
# RUN apt-get update && apt-get install -y \
# 		libfreetype-dev \
# 		libjpeg62-turbo-dev \
# 		libpng-dev \
# 	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
# 	&& docker-php-ext-install -j$(nproc) gd mysql

# RUN php -m
# RUN php -i