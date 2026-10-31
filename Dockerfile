FROM node:22-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json vite.config.js ./
RUN npm ci

COPY resources ./resources
RUN npm run build

FROM php:8.4-cli-alpine

RUN apk add --no-cache \
        icu-dev \
        libzip-dev \
        oniguruma-dev \
        sqlite-dev \
    && docker-php-ext-install \
        intl \
        mbstring \
        pdo_mysql \
        pdo_sqlite \
        zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
COPY --from=assets /app/public/build ./public/build

RUN composer install \
        --no-dev \
        --no-interaction \
        --prefer-dist \
        --optimize-autoloader \
    && mkdir -p \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
    && chmod +x docker-entrypoint.sh \
    && chown -R www-data:www-data database storage bootstrap/cache

USER www-data

EXPOSE 10000

CMD ["sh", "docker-entrypoint.sh"]
