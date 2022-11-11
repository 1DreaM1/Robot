FROM php:8.1-apache

COPY .docker/php-apache/php.ini /usr/local/etc/php/

RUN apt-get update -y && apt-get install -y -qq git \
	libwebp-dev\
	libpng-dev\
	zlib1g-dev \
	libjpeg62-turbo-dev \
	apt-transport-https \
	libfreetype6-dev \
	libmcrypt-dev \
	libssl-dev \
	libzip-dev \
	zip unzip \
	wget \
	msmtp \
    zlib1g-dev \
    libicu-dev g++ \
	vim

RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install -j$(nproc) iconv zip gd bcmath intl exif

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
