<?php

declare(strict_types=1);

/**
 * This file is part of the Webware Mezzio Bleeding Edge package.
 *
 * Copyright (c) 2026 Joey Smith <jsmith@webinertia.net>
 * and contributors.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mysql;

/**
 * @phpstan-type dependencyArray array{
 *                      delegators?: array<class-string, list<class-string>>,
 *                      factories?: array<class-string, class-string>,
 *                      invokables?: array<class-string, class-string>
 *               }
 * @phpstan-type routeProviderArray array{
 *                      route-providers: list<class-string>
 *                }
 * @phpstan-type templateArray array{
 *                      map: array<string, string>,
 *                      paths: array<string, list<string>>,
 *                      default_layout: string
 *                }
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @phpstan-return array{dependencies: dependencyArray, templates: templateArray, router: routeProviderArray}
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'router'       => $this->getRouteProviders(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @phpstan-return dependencyArray
     */
    public function getDependencies(): array
    {
        return [
            'factories'  => [
                Handler\PdoHandler::class => Container\PdoHandlerFactory::class,
                Handler\MysqliHandler::class => Container\MysqliHandlerFactory::class,
                RouteProvider::class           => Container\RouteProviderFactory::class,
            ],
        ];
    }

    /**
     * Returns the route provider configuration
     *
     * @phpstan-return routeProviderArray
     */
    public function getRouteProviders(): array
    {
        return [
            'route-providers' => [
                RouteProvider::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @phpstan-return templateArray
     */
    public function getTemplates(): array
    {
        return [
            'map'            => [
                'mysql::mysqli-page' => __DIR__ . '/../templates/mysql/mysqli-page.phtml',
                'mysql::pdo-page'    => __DIR__ . '/../templates/mysql/pdo-page.phtml',
            ],
            'paths'          => [
                'mysql' => [__DIR__ . '/../templates/mysql'],
            ],
        ];
    }
}
