#!/bin/bash

touch ./database/database.sqlite
composer install --prefer-dist --ignore-platform-reqs --no-scripts --quiet

if [ ! -f .env ]; then
    cp .env.example .env
fi

docker-compose build
