# Mezzio Bleeding Edge

This is a custom Mezzio skeleton which is built from the latest releases of all dependencies (to the extent possible).

- Skeleton uses a RouteProvider for routes instead of a config/routes.php file.
- It uses laminas/laminas-stratigility:"^4.3.0"
- Currently mezzio/mezzio-tooling can not be installed due to a conflict with stratigility.
  Which means that laminas/laminas-development-mode can not be installed. However, you can enable development
  mode manually in a config file with the following values.

  ```php
    'debug'                        => true,
    ConfigAggregator::ENABLE_CACHE => false,
    ```

- It sets en-US as the html elements lang attribute value.
- It uses PHPStan for static analysis rather than Psalm which is what laminas/mezzio uses.
  In its current state it passes at level 10 without a baseline.
- It uses Pico css framework rather than Bootstrap.
- It loads HTMX from a CDN.

Other than those details its setup pretty much the way you would expect a standard build of mezzio/mezzio-skeleton.
See below for the list of packages that are currently in use.

Why? Becuase those are the tools I usually start with for prototyping.

I'm sure this goes without saying but all you need do is fork/clone this locally and then run

```bash
composer install
```

```json
    "require": {
        "php": "~8.2.0 || ~8.3.0 || ~8.4.0 || ~8.5.0",
        "laminas/laminas-component-installer": "^3.7",
        "laminas/laminas-config-aggregator": "^1.19",
        "laminas/laminas-diactoros": "^3.8",
        "laminas/laminas-servicemanager": "^4.5",
        "laminas/laminas-stdlib": "^3.21",
        "laminas/laminas-view": "^3.0",
        "mezzio/mezzio": "^3.26",
        "mezzio/mezzio-fastroute": "^3.14",
        "mezzio/mezzio-helpers": "^5.20",
        "mezzio/mezzio-laminasviewrenderer": "^3.0"
    },
    "require-dev": {
        "filp/whoops": "^2.15.4",
        "laminas/laminas-coding-standard": "^3.1",
        "phpstan/phpstan": "^2.1",
        "phpstan/phpstan-phpunit": "^2.0",
        "phpunit/phpunit": "^11.5.42",
        "roave/security-advisories": "dev-master"
    },
```
