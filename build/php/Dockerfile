FROM php:8.3-fpm

ENV LOG_CHANNEL stderr

WORKDIR /var/www

RUN apt-get update \
    && apt-get -y install git zip libonig-dev libzip-dev libxml2-dev libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-install zip \
    && pecl install xdebug && docker-php-ext-enable xdebug \
    && pecl install redis && docker-php-ext-enable redis \
    && chown -R www-data:www-data /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./build/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

COPY ./build/php/entrypoint.sh /usr/bin
RUN chmod +x /usr/bin/entrypoint.sh

CMD ["/usr/bin/entrypoint.sh"]
