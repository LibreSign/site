#!/bin/bash

if [[ ! -d "vendor" ]]; then
    composer i
fi

if [[ ! -d "node_modules" ]]; then
    npm ci
fi

php-fpm &
PHP_FPM_PID=$!

cleanup() {
    if kill -0 "$PHP_FPM_PID" 2>/dev/null; then
        kill "$PHP_FPM_PID"
        wait "$PHP_FPM_PID" 2>/dev/null || true
    fi
}

trap cleanup EXIT INT TERM

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

    wait "$PHP_FPM_PID"
fi
