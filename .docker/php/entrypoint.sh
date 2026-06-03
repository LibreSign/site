#!/bin/bash

if [[ ! -d "vendor" ]]; then
    composer i
fi

if [[ ! -d "node_modules" ]]; then
    npm ci
fi

php-fpm &

MODE="${SERVER_MODE:-watch}"
MODE="$(echo "$MODE" | tr '[:upper:]' '[:lower:]' | xargs)"

echo "Starting php container with SERVER_MODE=$MODE"

if [[ "$MODE" == 'watch' ]]; then
    npm run watch
else
    rm -f "source/hot"

    if [[ ! -f "source/assets/build/manifest.json" ]]; then
        echo "Vite manifest missing. Running one-time asset build (npm run staging)..."
        npm run staging
    fi

    echo "Building local static site for nginx..."
    php ./vendor/bin/jigsaw build local
fi
