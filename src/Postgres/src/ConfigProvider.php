<?php

declare(strict_types=1);

namespace Postgres;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'router'       => $this->getRouteProviders(),
            'templates'    => $this->getTemplates(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories' => [
                Handler\PdoHandler::class => Container\PdoHandlerFactory::class,
                RouteProvider::class      => Container\RouteProviderFactory::class,
            ],
        ];
    }

    public function getRouteProviders(): array
    {
        return [
            'route-providers' => [
                RouteProvider::class,
            ],
        ];
    }

    public function getTemplates(): array
    {
        return [
            'map' => [
                'postgres::pdo' => __DIR__ . '/../templates/postgres/pdo.phtml',
            ],
            'paths' => [
                'postgres' => [__DIR__ . '/../templates/postgres'],
            ],
        ];
    }
}
