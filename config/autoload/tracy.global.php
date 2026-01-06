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

use Tracy\Debugger;

return [
    Debugger::class => [
        'enable'       => Debugger::Development, // or Debugger::Production - disables tracy in production
        'dumpTheme'    => 'dark',
        'showLocation' => true,
        'keysToHide'   => [
            'password',
            'pass',
            'secret',
        ],
    ],
];
