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
    # Remove the Vite hot file so Jigsaw uses the compiled manifest
    # instead of pointing HTML to the dev server.
    rm -f "source/hot"

    # Build Vite assets and the local static site in one step.
    # NODE_ENV=local causes the plugin to run `jigsaw build local`,
    # so build_local is ready for nginx with no leftover build_staging.
    npm run build-assets
    exec php-fpm -F
fi
