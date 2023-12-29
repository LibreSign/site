#!/bin/bash

# Set uid of host machine
usermod --non-unique --uid "${HOST_UID}" www-data
groupmod --non-unique --gid "${HOST_GID}" www-data

if [ ! -d "vendor" ]; then
    composer i
fi

npm run watch
