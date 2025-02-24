<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Bundle\Traits;

use Psr\Container\ContainerInterface;
use Shrikeh\ApiContext\Bundle\Exception\ServiceNotFound;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

trait ContainerExtension
{
    private readonly ContainerInterface $serviceLocator;
    private readonly string $extensionClass;

    public function getContainerExtension(): ExtensionInterface
    {
        /** @phpstan-ignore if.alwaysFalse */
        if ($this->serviceLocator->has($this->extensionClass)) {
            /** @phpstan-ignore symfonyContainer.privateService */
            return $this->serviceLocator->get($this->extensionClass);
        }

        throw new ServiceNotFound($this->serviceLocator, $this->extensionClass);
    }
}
