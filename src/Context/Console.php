<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Context;

use Pimple\Container;
use Shrikeh\ApiContext\Context;
use Shrikeh\ApiContext\ServiceProvider\Console as ConsoleServiceProvider;
use Shrikeh\ApiContext\Kernel\Service;
use Symfony\Bundle\FrameworkBundle\Console\Application;

final readonly class Console implements Context
{
    public function __construct(private string $rootDir)
    {
    }

    public function __invoke(array $context): mixed
    {
        $container = new Container();
        $container->register(new ConsoleServiceProvider(
            $this->rootDir,
            $context['APP_ENV'],
            (bool) $context['APP_DEBUG']
        ));

        return new Application($container[Service::KERNEL->key()]);
    }
}
