FROM php:7.2-fpm


ARG HOST_UID
ARG PHP_PORT

RUN usermod -u $HOST_UID www-data

RUN apt-get update

RUN apt-get install -y gettext
RUN apt-get install git -y
RUN apt-get install wget -y
RUN apt-get install libmcrypt-dev -y
RUN apt-get install -y libxml2-dev
RUN apt-get install -y libpng-dev libfreetype6-dev libjpeg62-turbo-dev libxpm-dev libwebp-dev
RUN apt-get install -y libmemcached-dev
RUN apt-get install -y imagemagick
RUN apt-get install -y zlib1g-dev libicu-dev g++

# php extensions
RUN pecl install mcrypt-1.0.2  && docker-php-ext-enable mcrypt
RUN docker-php-ext-install -j$(nproc) iconv
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ \
    --with-xpm-dir=/usr/include \
    --with-webp-dir=/usr/include/ \
    && docker-php-ext-install gd
RUN docker-php-ext-install xml
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install opcache
RUN pecl install apcu && docker-php-ext-enable apcu
RUN docker-php-ext-install zip
RUN docker-php-ext-install intl
RUN docker-php-ext-install bcmath
RUN apt-get install -y libgmp-dev && docker-php-ext-install gmp

# www.conf
COPY www.conf.template /usr/local/etc/php-fpm.d/www.conf.template
RUN envsubst '$HOST_UID $PHP_PORT' < /usr/local/etc/php-fpm.d/www.conf.template > /usr/local/etc/php-fpm.d/www.conf

# install composer
COPY install-composer.sh /tmp/install-composer.sh
RUN chmod +x /tmp/install-composer.sh
RUN bash /tmp/install-composer.sh
VOLUME /root/.composer
