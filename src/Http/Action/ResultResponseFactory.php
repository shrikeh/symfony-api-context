<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Http\Action;

use Psr\Http\Message\ResponseInterface;
use Shrikeh\App\Message\Result;

interface ResultResponseFactory
{
    public function createResponseFromResult(Result $result): ResponseInterface;

    public function supports(Result $result): bool;
}
