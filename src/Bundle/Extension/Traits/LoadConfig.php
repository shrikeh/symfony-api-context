<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Bundle\Extension\Traits;

use Psr\Container\ContainerInterface;
use Shrikeh\ApiContext\Bundle\Factory\ConfigLoader;
use SplFileInfo;
use Symfony\Component\DependencyInjection\ContainerBuilder;

trait LoadConfig
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        /** @phpstan-ignore symfonyContainer.privateService  (This is not the Symfony container) */
        $loader = $this->serviceLocator()->get(ConfigLoader::class)->loader(
            $container,
            $this->configPath()
        );
        $loader->load($this->configPath()->getFilename());
    }

    abstract private function serviceLocator(): ContainerInterface;

    abstract private function configPath(): SplFileInfo;
}