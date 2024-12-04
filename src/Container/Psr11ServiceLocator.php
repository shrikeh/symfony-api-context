<?php

/*
 * This file is part of Barney's Symfony skeleton for Domain-Driven Design
 *
 * (c) Barney Hanlon <symfony@shrikeh.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Shrikeh\ApiContext\Container;

use Pimple\Container as PimpleContainer;
use Pimple\Exception\UnknownIdentifierException;
use Psr\Container\ContainerInterface;

use function is_int;

/**
 * @author Barney Hanlon <symfony@shrikeh.net>
 * Pimple provides a ServiceLocator, but it doesn't return a mixed type, causing deprecation errors. Nor does it
 * support readonly variables.
 */
final readonly class Psr11ServiceLocator implements ContainerInterface
{
    private array $aliases;

    public function __construct(private PimpleContainer $container, array $ids)
    {
        $aliases = [];
        foreach ($ids as $key => $id) {
            $aliases[is_int($key) ? $id : $key] = $id;
        }

        $this->aliases = $aliases;
    }

    /**
     * @inheritDoc
     */
    public function get(string $id): mixed
    {
        if (!isset($this->aliases[$id])) {
            throw new UnknownIdentifierException($id);
        }

        return $this->container[$this->aliases[$id]];
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        return isset($this->aliases[$id]) && isset($this->container[$this->aliases[$id]]);
    }
}
