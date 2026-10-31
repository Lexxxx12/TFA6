#!/bin/sh
set -eu

export APP_KEY="${APP_KEY:-$(php artisan key:generate --show --no-interaction)}"
export APP_URL="${APP_URL:-${RENDER_EXTERNAL_URL:-http://localhost:10000}}"
export DB_CONNECTION="${DB_CONNECTION:-sqlite}"

if [ "$DB_CONNECTION" = "sqlite" ]; then
    export DB_DATABASE="${DB_DATABASE:-/var/www/html/database/database.sqlite}"
    mkdir -p "$(dirname "$DB_DATABASE")"
    touch "$DB_DATABASE"
fi

php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}" --no-interaction
