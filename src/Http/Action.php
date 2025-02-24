<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface Action
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface;
}
