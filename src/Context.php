<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext;

interface Context
{
    public function __invoke(array $context): mixed;
}