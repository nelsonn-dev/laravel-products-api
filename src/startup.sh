#!/bin/sh
FIRST_RUN=false

if [ ! -e .env ]
then
    FIRST_RUN=true
    echo "ENV file not found, creating new one based on Example."
    cp .env.example .env
    php artisan key:generate
fi

if [ ! -d ./vendor/laravel ]
then
    echo "Packages not installed in vendor, running composer install."
    composer install
fi

if [ "$FIRST_RUN" = true ]
then
    echo "First time running the app, making migration and seeding."

    php artisan migrate

    php artisan db:seed
fi

php artisan serve --host=0.0.0.0