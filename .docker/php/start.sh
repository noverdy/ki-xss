#!/bin/sh

composer install
php artisan migrate --seed
php-fpm