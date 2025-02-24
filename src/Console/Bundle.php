<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Console;

use Psr\Container\ContainerInterface;
use Shrikeh\ApiContext\Bundle\Traits\ContainerExtension;
use Shrikeh\ApiContext\Console\DependencyInjection\ConsoleExtension;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class Bundle extends AbstractBundle
{
    use ContainerExtension;

    public const string DEFAULT_BUNDLE_NAME = 'Console';

    public function __construct(
        ContainerInterface $serviceLocator,
        string $name = self::DEFAULT_BUNDLE_NAME
    ) {
        $this->serviceLocator = $serviceLocator;
        $this->extensionClass = ConsoleExtension::class;
        $this->name = $name;
    }
}
