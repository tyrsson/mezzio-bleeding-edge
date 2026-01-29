<?php

declare(strict_types=1);

namespace Mysql\Container;

use PhpDb\Adapter\AdapterInterface;
use Mysql\Handler\MysqliHandler;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

final class MysqliHandlerFactory
{
    public function __invoke(ContainerInterface $container): MysqliHandler
    {
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        return new MysqliHandler(
            $container->get(AdapterInterface::class),
            $template
        );
    }
}
