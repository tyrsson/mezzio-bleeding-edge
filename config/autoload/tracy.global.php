<?php

declare(strict_types=1);

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
        ]
    ],
];