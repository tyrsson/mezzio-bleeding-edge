<?php

declare(strict_types=1);

namespace App;

use Mezzio\MiddlewareFactoryInterface;
use Mezzio\Router\RouteCollectorInterface;
use Mezzio\Router\RouteProviderInterface;

final class RouteProvider implements RouteProviderInterface
{
    public function registerRoutes(
        RouteCollectorInterface $routeCollector,
        MiddlewareFactoryInterface $middlewareFactory
    ): void {
        $routeCollector->get(
            '/',
            $middlewareFactory->prepare(
                Handler\HomePageHandler::class
            ),
            'home'
        );

        $routeCollector->get(
            '/ping',
            $middlewareFactory->prepare(
                Handler\PingHandler::class
            ),
            'api.ping'
        );
    }
}
