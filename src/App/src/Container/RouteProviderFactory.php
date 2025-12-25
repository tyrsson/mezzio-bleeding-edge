<?php

declare(strict_types=1);

namespace App\Container;

use App\RouteProvider;
use Psr\Container\ContainerInterface;

final class RouteProviderFactory
{
    public function __invoke(ContainerInterface $container): RouteProvider
    {
        return new RouteProvider();
    }
}
