<?php

declare(strict_types=1);

namespace Tests\Api\Http\Action;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Shrikeh\ApiContext\Http\Action;
use Teapot\StatusCode;
use Twig\Environment;

final readonly class TestAction implements Action
{
    public function __construct(private Environment $twig)
    {
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(
            status: StatusCode::OK,
            body: $this->twig->render('test.twig'),
        );
    }
}
