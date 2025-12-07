<?php

declare(strict_types=1);

namespace App;

use Mezzio\Application;
use Mezzio\Container\ApplicationConfigInjectionDelegator;

class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'routes'       => $this->getRoutes(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'delegators' => [
                Application::class => [
                    ApplicationConfigInjectionDelegator::class,
                ],
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
            ],
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'map' => [
                'layout' => __DIR__ . '/../templates/layout/layout.phtml',
                'app::home-page' => __DIR__ . '/../templates/app/home-page.phtml',
                'error::404'     => __DIR__ . '/../templates/error/404.phtml',
                'error::error'   => __DIR__ . '/../templates/error/error.phtml',
            ],
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
            ],
            'default_layout' => 'layout',
        ];
    }

    /**
     * Returns the application routes
     */
    public function getRoutes(): array
    {
        return [
            [
                'name'       => 'home',
                'path'       => '/',
                'middleware' => Handler\HomePageHandler::class,
                'allowed_methods' => ['GET'],
            ],
            [
                'name'       => 'api.ping',
                'path'       => '/ping',
                'middleware' => Handler\PingHandler::class,
                'allowed_methods' => ['GET'],
            ],
        ];
    }
}
