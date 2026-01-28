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

namespace Postgres\Handler;

use Laminas\Diactoros\Response;
use Mezzio\Template\TemplateRendererInterface;
use PhpDb\Adapter\AdapterInterface;
use PhpDb\Adapter\Pgsql\Metadata;
use PhpDb\ResultSet\ResultSet;
use PhpDB\Sql;
use PhpDb\TableGateway\TableGateway;
use PhpDb\TableGateway\Feature;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Tracy\Debugger;

final class PdoHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ?TemplateRendererInterface $template = null,
        private readonly AdapterInterface $adapter,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [
            'message' => 'You are running the Postgres Driver.',
        ];
        if (null === $this->template) {
            return new Response\JsonResponse($data);
        }

        $gateway = new TableGateway(
            'test',
            $this->adapter
        );
        /** @var Metadata\Source $metaData */
        $metaData = new Metadata\Source($this->adapter);
        $tables   = $metaData->getTableNames();
        Debugger::barDump($tables, 'Tables');
        $sql     = $gateway->getSql();
        $select  = $sql->select();
        /** @var ResultSet $result */
        $result  = $gateway->selectWith($select);
        Debugger::barDump($result->toArray(), 'Postgres PDO Result');

        return new Response\HtmlResponse($this->template->render('postgres::pdo', $data));
    }
}
