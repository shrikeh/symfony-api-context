<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Kernel;

use Generator;
use Psr\Container\ContainerInterface;
use Shrikeh\ApiContext\Kernel\Traits\ConfigContainer;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

final class DefaultKernel extends BaseKernel
{
    use MicroKernelTrait, ConfigContainer {
        ConfigContainer::getConfigDir insteadof MicroKernelTrait;
        ConfigContainer::registerBundles insteadof MicroKernelTrait;
    }

    public const ENVS_ALL = 'all';

    public function __construct(
        private readonly ContainerInterface $configContainer,
        string $environment,
        bool $debug,
    ) {
        parent::__construct($environment, $debug);
    }

    private function getConfigContainer(): ContainerInterface
    {
        return $this->configContainer;
    }
}
