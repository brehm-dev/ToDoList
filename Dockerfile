FROM php:7.4-fpm

# Arguments
ARG user
ARG uid
ARG timezone

# Set Timezone
RUN ln -snf /usr/share/zoneinfo/$timezone /etc/localtime && echo $timezone > /etc/timezone

# Install system dependencies
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    vim

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Enable XDebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -ms /bin/bash $user
RUN mkdir -p /var/run/php/ && chown -Rf www-data:www-data /var/run/php/

COPY ./docker-compose/php/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/
COPY ./docker-compose/php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker-compose/php/xdebug.conf /usr/local/etc/php-fpm.d/xdebug.conf
#RUN mkdir -p /var/run/php && chown -R www-data:$user /var/run/php && chmod -R ug+rwx /var/run/php
#RUN mkdir -p /home/$user/.composer && \
#    chown -R $uid:$uid /home/$user

WORKDIR /var/www

USER $user

