<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Bundle\Extension\Traits;

use Psr\Http\Message\UriInterface;

trait XsdNamespace
{
    private readonly string $alias;

    private readonly UriInterface $namespace;

    public function getNamespace(): string
    {
        return sprintf(
            '%s/%s',
            $this->namespace,
            $this->getAlias()
        );
    }

    public function getXsdValidationBasePath(): string|false
    {
        return false;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }
}