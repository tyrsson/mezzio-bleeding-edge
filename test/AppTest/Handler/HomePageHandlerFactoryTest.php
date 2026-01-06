<?php

declare(strict_types=1);

/*
 * This file is part of the Mezzio Bleeding Edge Skeleton App.
 *
 * Copyright (c) 2025-2026 Joey Smith <jsmith@webinertia.net>
 * and contributors.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppTest\Handler;

use App\Container\HomePageHandlerFactory;
use App\Handler\HomePageHandler;
use AppTest\InMemoryContainer;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(HomePageHandlerFactory::class)]
#[CoversMethod(HomePageHandlerFactory::class, '__invoke')]
final class HomePageHandlerFactoryTest extends TestCase
{
    public function testFactoryWithoutTemplate(): void
    {
        $container = new InMemoryContainer();

        $factory  = new HomePageHandlerFactory();
        $homePage = $factory($container);

        self::assertInstanceOf(HomePageHandler::class, $homePage);
    }

    public function testFactoryWithTemplate(): void
    {
        $container = new InMemoryContainer();
        $container->setService(TemplateRendererInterface::class, $this->createMock(TemplateRendererInterface::class));

        $factory  = new HomePageHandlerFactory();
        $homePage = $factory($container);

        self::assertInstanceOf(HomePageHandler::class, $homePage);
    }
}
