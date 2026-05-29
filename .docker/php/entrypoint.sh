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
    if [[ ! -f "source/assets/build/mix-manifest.json" ]]; then
        echo "Mix manifest missing. Running one-time asset build (npm run dev)..."
        npm run dev
    fi

    php ./vendor/bin/jigsaw serve --host 0.0.0.0 --port 3000
fi
