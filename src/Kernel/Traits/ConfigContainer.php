<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Kernel\Traits;

use Generator;
use Psr\Container\ContainerInterface;
use Shrikeh\ApiContext\Kernel\Service;

trait ConfigContainer
{
    public function __construct(
        private readonly ContainerInterface $configContainer,
        protected string $environment,
        protected bool $debug,
    ) {
        parent::__construct($environment, $this->debug);
    }

    public function getProjectDir(): string
    {
        return $this->getConfigContainer()->get(Service::PROJECT_DIR_PATH->key());
    }

    public function registerBundles(): iterable
    {
        return $this->getConfigContainer()->get(Service::KERNEL_BUNDLES->key());
    }

    private function getConfigDir(): string
    {
        return $this->getConfigContainer()->get(Service::KERNEL_CONFIG_DIR->key());
    }

    abstract private function getConfigContainer(): ContainerInterface;
}
