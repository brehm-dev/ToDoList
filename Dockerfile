FROM webdevops/php-apache-dev:7.4

# Arguments
#ARG user
#ARG uid
#ARG tz

# Set Timezone
#RUN ln -snf /usr/share/zoneinfo/$tz /etc/localtime && echo $tz > /etc/timezone

# Install system dependencies
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y apt-utils libpng-dev libonig-dev libxml2-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Possible extensions for docker-php-ext-install
#
# bcmath bz2 calendar ctype curl dba dom enchant exif ffi fileinfo filter ftp gd gettext
# gmp hash iconv imap intl json ldap mbstring mysqli oci8 odbc opcache pcntl pdo pdo_dblib
# pdo_firebird pdo_mysql pdo_oci pdo_odbc pdo_pgsql pdo_sqlite pgsql phar posix pspell readline
# reflection session shmop simplexml snmp soap sockets sodium spl standard sysvmsg sysvsem sysvshm
# tidy tokenizer xml xmlreader xmlrpc xmlwriter xsl zend_test zip
#
# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Enable XDebug
#RUN pecl install xdebug && docker-php-ext-enable xdebug
# Get latest Composer
#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
#RUN /opt/docker/etc/httpd/vhost.common.d/
# Create system user to run Composer and Artisan Commands
#RUN useradd -G www-data,root -u $uid -ms /bin/bash $user
#RUN mkdir -p /var/run/php/ && chown -Rf www-data:www-data /var/run/php/

#COPY ./docker-compose/php/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/
#COPY ./docker-compose/php/www.conf /usr/local/etc/php-fpm.d/www.conf
#COPY ./docker-compose/php/xdebug.conf /usr/local/etc/php-fpm.d/xdebug.conf
#RUN mkdir -p /var/run/php && chown -R www-data:$user /var/run/php && chmod -R ug+rwx /var/run/php
#RUN mkdir -p /home/$user/.composer && \
#    chown -R $uid:$uid /home/$user

WORKDIR /var/www


