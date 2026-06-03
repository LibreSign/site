#!/bin/bash

set -euo pipefail

if [[ ! -d "vendor" ]]; then
    composer i
fi

if [[ ! -d "node_modules" ]]; then
    npm ci
fi

MODE="${SERVER_MODE:-watch}"
MODE="$(echo "$MODE" | tr '[:upper:]' '[:lower:]' | xargs)"

echo "Starting php container with SERVER_MODE=$MODE"

if [[ "$MODE" == 'watch' ]]; then
    php-fpm -D
    exec npm run watch
else
    # The Vite hot file tells Jigsaw/Laravel to reference the dev server
    # directly instead of the compiled manifest. For the nginx-served local
    # site we always want the static build output from source/assets/build.
    rm -f "source/hot"

    if [[ ! -f "source/assets/build/manifest.json" ]]; then
        echo "Vite manifest missing. Running one-time asset build (npm run staging)..."
        npm run staging
        rm -rf build_staging
    fi

    echo "Building local static site for nginx..."
    php ./vendor/bin/jigsaw build local
    exec php-fpm -F
fi
