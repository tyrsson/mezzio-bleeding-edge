<?php

declare(strict_types=1);

/**
 * This file is part of the Webware Mezzio Bleeding Edge package.
 *
 * Copyright (c) 2026 Joey Smith <jsmith@webinertia.net>
 * and contributors.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mysql\Handler;

use Laminas\Diactoros\Response;
use Mezzio\Template\TemplateRendererInterface;
use PhpDb\Adapter\AdapterInterface;
use PhpDb\Mysql\Metadata\Source;
use PhpDb\TableGateway\TableGateway;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Tracy\Debugger;

final class MysqliHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly AdapterInterface $adapter,
        private readonly ?TemplateRendererInterface $template = null,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [
            'message' => 'Mysql\Mysqli',
        ];
        if (null === $this->template) {
            return new Response\JsonResponse($data);
        }

        $tableGateway = new TableGateway('test', $this->adapter);
        $metaData     = new Source($this->adapter);
        Debugger::barDump($tableGateway->select()->toArray(), 'MysqliHandler: Table Data');
        Debugger::barDump($tableGateway->select()->toArray(), 'MysqliHandler: Table Data');
        Debugger::barDump($metaData->getTableNames(), 'MysqliHandler: Tables');
        Debugger::barDump($metaData->getTableNames(), 'MysqliHandler: Tables');

        return new Response\HtmlResponse($this->template->render('mysql::mysqli-page', $data));
    }
}
