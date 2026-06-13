FROM php:8.3-fpm

RUN apt-get update \
    && apt-get install -y \
        git \
        espeak-ng \
    # Clean package cache
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions and Composer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync \
    && install-php-extensions \
    gd \
    intl \
    xdebug \
    zip \
    @composer \
    && rm /usr/local/bin/install-php-extensions

COPY xdebug.ini /usr/local/etc/php/conf.d/
COPY dev.ini /usr/local/etc/php/conf.d/zz-dev.ini

# Install NVM
RUN export NVM_DIR="/usr/local/nvm" \
    && mkdir -p "$NVM_DIR" \
    && curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/master/install.sh | bash \
    && . "$NVM_DIR/nvm.sh" \
    && nvm install 24 \
    && nvm alias default 24 \
    && NODE_VERSION="$(nvm version default)" \
    && ln -s "$NVM_DIR/versions/node/$NODE_VERSION/bin/node" /usr/local/bin/node \
    && ln -s "$NVM_DIR/versions/node/$NODE_VERSION/bin/npm" /usr/local/bin/npm \
    && ln -s "$NVM_DIR/versions/node/$NODE_VERSION/bin/npx" /usr/local/bin/npx \
    && echo 'export NVM_DIR="/usr/local/nvm"' > /etc/profile.d/nvm.sh \
    && echo '[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"' >> /etc/profile.d/nvm.sh

RUN cat <<'EOF' >> /etc/bash.bashrc
alias jigsaw=./vendor/bin/jigsaw
alias compile='./vendor/bin/jigsaw build'
if ! getent passwd "$(id -u)" >/dev/null 2>&1; then
    PS1='container:\w\$ '
fi
EOF

WORKDIR /var/www/html
ENV HISTFILE=/dev/null
USER www-data

COPY entrypoint.sh /var/www/scripts/
ENTRYPOINT [ "bash", "/var/www/scripts/entrypoint.sh" ]
