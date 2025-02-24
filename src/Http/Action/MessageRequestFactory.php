<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Http\Action;

use Psr\Http\Message\ServerRequestInterface;
use Shrikeh\App\Message;

interface MessageRequestFactory
{
    public function createMessageFromRequest(ServerRequestInterface $request): Message;
}
