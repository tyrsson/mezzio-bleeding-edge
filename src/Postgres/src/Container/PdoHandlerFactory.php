<?php

declare(strict_types=1);

namespace Postgres\Container;

use Mezzio\Template\TemplateRendererInterface;
use PhpDb\Adapter\AdapterInterface;
use Postgres\Handler\PdoHandler;
use Psr\Container\ContainerInterface;

final class PdoHandlerFactory
{
    public function __invoke(ContainerInterface $container): PdoHandler
    {
        return new PdoHandler(
            template: $container->has(TemplateRendererInterface::class)
                ? $container->get(TemplateRendererInterface::class)
                : null,
            adapter: $container->get(AdapterInterface::class),
        );
    }
}
