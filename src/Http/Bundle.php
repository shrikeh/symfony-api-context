<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Http;

use Psr\Container\ContainerInterface;
use Shrikeh\ApiContext\Bundle\Traits\ContainerExtension;
use Shrikeh\ApiContext\Http\DependencyInjection\HttpExtension;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class Bundle extends AbstractBundle
{
    use ContainerExtension;

    public const string DEFAULT_BUNDLE_NAME = 'Http';

    public function __construct(
        ContainerInterface $serviceLocator,
        string $name = self::DEFAULT_BUNDLE_NAME
    ) {
        $this->serviceLocator = $serviceLocator;
        $this->extensionClass = HttpExtension::class;
        $this->name = $name;
    }
}
