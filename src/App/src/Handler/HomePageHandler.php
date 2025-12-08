<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class HomePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly ?TemplateRendererInterface $template = null
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [
            'message' => 'Welcome to Mezzio!',
        ];
        if (null === $this->template) {
            return new Response\JsonResponse($data);
        }
        return new Response\HtmlResponse($this->template->render('app::home-page', $data));
    }
}
