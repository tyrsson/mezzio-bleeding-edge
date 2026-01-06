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

namespace AppTest;

use Psr\Container\ContainerInterface;
use RuntimeException;

use function array_key_exists;
use function sprintf;

/**
 * A PSR Container stub. Useful for testing factories without excessive mocking
 */
final class InMemoryContainer implements ContainerInterface
{
    /** @var array<string, mixed> */
    public array $services = [];

    public function setService(string $name, mixed $service): void
    {
        $this->services[$name] = $service;
    }

    public function get(string $id): mixed
    {
        if (! $this->has($id)) {
            throw new RuntimeException(sprintf('Service not found "%s"', $id));
        }

        return $this->services[$id];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }
}
