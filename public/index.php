<?php

declare(strict_types=1);

use Tracy\Debugger;

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * Self-called anonymous function that creates its own scope and keeps the global namespace clean.
 */
(function () {

    $hasTracy = class_exists(Debugger::class);

    if ($hasTracy) {
        Debugger::enable(Debugger::DEVELOPMENT);
        Debugger::timer('build-container');
    }
    /** @var \Psr\Container\ContainerInterface $container */
    $container = require 'config/container.php';
    if ($hasTracy) {
        $buildContainer = Debugger::timer('build-container');
    }

    /** @var \Mezzio\Application $app */
    $app = $container->get(\Mezzio\Application::class);
    $factory = $container->get(\Mezzio\MiddlewareFactory::class);

    if ($hasTracy) {
        Debugger::timer('build-pipeline');
    }
    // Execute programmatic/declarative middleware pipeline and routing
    // configuration statements
    (require 'config/pipeline.php')($app, $factory, $container);

    if ($hasTracy) {
        $buildPipeline = Debugger::timer('build-pipeline');
    }

    if ($hasTracy) {
        Debugger::timer('app-run');
    }

    $app->run();

    if ($hasTracy) {
        $appRun = Debugger::timer('app-run');
        Debugger::barDump(
            [
                'buildContainer' => $buildContainer,
                'buildPipeline'  => $buildPipeline,
                'appRun'         => $appRun,
            ],
        );
    }

})();
