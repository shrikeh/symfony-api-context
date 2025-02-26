<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Context;

use Pimple\Container;
use Shrikeh\ApiContext\Context;
use Shrikeh\ApiContext\ServiceProvider\Console as ConsoleServiceProvider;
use Shrikeh\ApiContext\Kernel\Service;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpKernel\KernelInterface;

final readonly class Console implements Context
{
    public function __construct(
        private string $rootDir,
        private Container $container = new Container()
    ) {

    }

    public function __invoke(array $context): mixed
    {
        return new Application($this->kernel($context));
    }

    public function kernel(array $context): KernelInterface
    {
        $this->container->register(new ConsoleServiceProvider(
            $this->rootDir,
            $context['APP_ENV'],
            (bool) $context['APP_DEBUG']
        ));

        return $this->container[Service::KERNEL->key()];
    }
}
