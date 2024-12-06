<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Http\Action\ResultResponseFactory\Traits;

use Psr\Http\Message\ResponseInterface;
use Shrikeh\ApiContext\Http\Action\ResultResponseFactory\Exception\UnsupportedResult;
use Shrikeh\App\Message\Result;

trait SupportedResult
{
    public function createResponseFromResult(Result $result): ResponseInterface
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResult($result);
        }

        return $this->createResponseFromSupportedResult($result);
    }

    abstract public function supports(Result $result): bool;

    abstract private function createResponseFromSupportedResult(Result $result): ResponseInterface;
}
