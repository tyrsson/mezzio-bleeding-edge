<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\PingHandler;
use Laminas\Diactoros\Response\JsonResponse;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

use function json_decode;
use function property_exists;

use const JSON_THROW_ON_ERROR;

#[CoversClass(PingHandler::class)]
#[CoversMethod(PingHandler::class, 'handle')]
final class PingHandlerTest extends TestCase
{
    public function testResponse(): void
    {
        $pingHandler = new PingHandler();
        $response    = $pingHandler->handle(
            $this->createMock(ServerRequestInterface::class)
        );

        /** @var object{ack: string} $json */
        $json = json_decode((string) $response->getBody(), null, 512, JSON_THROW_ON_ERROR);

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertTrue(property_exists($json, 'ack') && $json->ack !== null);
    }
}
