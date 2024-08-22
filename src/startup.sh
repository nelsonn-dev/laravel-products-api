#!/bin/sh

if [ ! -e .env ]
then
    echo "ENV file not found, creating new one based on Example."
    cp .env.example .env
fi

if [ ! -d ./vendor/laravel ]
then
    echo "Packages not installed in vendor, running composer install."
    composer install
fi

php artisan migrate

php artisan serve --host=0.0.0.0