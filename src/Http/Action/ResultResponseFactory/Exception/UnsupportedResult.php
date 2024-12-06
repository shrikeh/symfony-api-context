<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Http\Action\ResultResponseFactory\Exception;

use InvalidArgumentException;
use Shrikeh\App\Message\Result;

final class UnsupportedResult extends InvalidArgumentException implements ResultResponseFactoryException
{
    public function __construct(public readonly Result $result)
    {
        parent::__construct(
            message: sprintf('Result of type %s is not supported by this factory', get_class($this->result))
        );
    }
}
