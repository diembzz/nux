FROM php:8.3-fpm-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin
RUN install-php-extensions pgsql pdo_pgsql zip intl opcache bcmath @composer

CMD ["/bin/sh", "-c" , "php-fpm -F"]
