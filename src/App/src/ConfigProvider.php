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

namespace App;

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
     * @phpstan-return array{dependencies: dependencyArray, templates: templateArray}
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
                Handler\HomePageHandler::class => Container\HomePageHandlerFactory::class,
                RouteProvider::class           => Container\RouteProviderFactory::class,
            ],
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
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
                'layout::default' => __DIR__ . '/../templates/layout/default.phtml',
                'app::home-page'  => __DIR__ . '/../templates/app/home-page.phtml',
                'error::404'      => __DIR__ . '/../templates/error/404.phtml',
                'error::error'    => __DIR__ . '/../templates/error/error.phtml',
            ],
            'paths'          => [
                'app'   => [__DIR__ . '/../templates/app'],
                'error' => [__DIR__ . '/../templates/error'],
            ],
            'default_layout' => 'layout::default',
        ];
    }
}
