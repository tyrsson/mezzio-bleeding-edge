ARG PHP_VERSION=8.3

FROM phpswoole/swoole:6.1-php${PHP_VERSION}

WORKDIR /var/www

# mezzio/mezzio-swoole requires ext-intl, which isn't present in the base image.
RUN apt-get update \
    && apt-get install -y --no-install-recommends libicu-dev \
    && docker-php-ext-install intl \
    && rm -rf /var/lib/apt/lists/*

COPY docker/swoole/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["vendor/bin/laminas", "mezzio:swoole:start"]
