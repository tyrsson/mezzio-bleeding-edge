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

use Mezzio\MiddlewareFactoryInterface;
use Mezzio\Router\RouteCollectorInterface;
use Mezzio\Router\RouteProviderInterface;

final class RouteProvider implements RouteProviderInterface
{
    public function registerRoutes(
        RouteCollectorInterface $routeCollector,
        MiddlewareFactoryInterface $middlewareFactory,
    ): void {
        $routeCollector->get(
            '/mysql/mysqli',
            $middlewareFactory->prepare(
                Handler\MysqliHandler::class
            ),
            'mysql.mysqli'
        );

        $routeCollector->get(
            '/mysql/pdo',
            $middlewareFactory->prepare(
                Handler\PdoHandler::class
            ),
            'mysql.pdo'
        );
    }
}
