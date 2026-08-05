#!/bin/sh
set -e

if [ -f composer.json ]; then
    if ! grep -q '"mezzio/mezzio-swoole"' composer.json; then
        echo "==> Requiring mezzio/mezzio-swoole"
        composer require mezzio/mezzio-swoole --no-interaction
    else
        echo "==> Installing composer dependencies"
        composer install --no-interaction
    fi

    # vendor/bin/laminas (laminas-cli) is required to run `mezzio:swoole:start`.
    if ! grep -q '"laminas/laminas-cli"' composer.json; then
        echo "==> Requiring laminas/laminas-cli"
        composer require laminas/laminas-cli --no-interaction
    fi
fi

if [ ! -f config/autoload/swoole.local.php ]; then
    echo "==> Writing config/autoload/swoole.local.php"
    cat > config/autoload/swoole.local.php <<'PHP'
<?php

declare(strict_types=1);

use Mezzio\Swoole\ConfigProvider;

return array_merge((new ConfigProvider())(), [
    'mezzio-swoole' => [
        'swoole-http-server' => [
            // Bind to all interfaces so the server is reachable from the host.
            'host' => '0.0.0.0',
            'port' => 8080,
        ],
    ],
]);
PHP
fi

exec "$@"
