<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Bundle\Exception;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;
use Shrikeh\ApiContext\Exception\Message;

final class ServiceNotFound extends RuntimeException implements BundleException, NotFoundExceptionInterface
{
    public const Message MSG = Message::SERVICE_NOT_FOUND;

    public function __construct(public readonly ContainerInterface $container, public readonly string $identifier)
    {
        parent::__construct(self::MSG->message($identifier));
    }
}
