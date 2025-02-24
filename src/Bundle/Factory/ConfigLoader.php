<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Bundle\Factory;

use SplFileInfo;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

interface ConfigLoader
{
    public function loader(ContainerBuilder $containerBuilder, SplFileInfo $configFile): LoaderInterface;
}
