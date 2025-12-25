<?php

declare(strict_types=1);

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
