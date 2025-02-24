<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Context;

use Pimple\Container;
use Shrikeh\ApiContext\Context;
use Shrikeh\ApiContext\ServiceProvider\Http as HttpServiceProvider;
use Shrikeh\ApiContext\Kernel\Service;

final readonly class Http implements Context
{
    public function __construct(private string $rootDir)
    {
    }

    public function __invoke(array $context): mixed
    {
        $container = new Container();
        $container->register(new HttpServiceProvider(
            $this->rootDir,
            $context['APP_ENV'],
            (bool) $context['APP_DEBUG']
        ));

        return $container[Service::KERNEL->key()];
    }
}
