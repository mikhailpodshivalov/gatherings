#!/bin/bash

cd /var/www

if [ ! -f ".env" ]; then
    cp .env.example .env
fi
composer install
php artisan key:generate
php artisan optimize

php-fpm
