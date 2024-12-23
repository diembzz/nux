FROM php:8.3-fpm-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin
RUN install-php-extensions pdo_sqlite sqlite3 zip intl opcache bcmath @composer

CMD ["/bin/sh", "-c" , "./artisan migrate && php-fpm -F"]
