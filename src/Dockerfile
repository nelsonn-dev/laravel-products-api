FROM php:8.3.10-alpine3.20

COPY --from=composer/composer:2.2-bin /composer /usr/bin/composer

# ENTRYPOINT ["tail", "-f", "/dev/null"]