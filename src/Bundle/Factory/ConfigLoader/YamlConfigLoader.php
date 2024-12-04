<?php

/*
 * This file is part of Barney's Symfony skeleton for Domain-Driven Design
 *
 * (c) Barney Hanlon <symfony@shrikeh.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Shrikeh\ApiContext\Bundle\Factory\ConfigLoader;

use Shrikeh\ApiContext\Bundle\Factory\ConfigLoader;
use Shrikeh\ApiContext\Factory\ConfigLoader\Exception\ConfigFileIsUnreadable;
use SplFileInfo;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author Barney Hanlon <symfony@shrikeh.net>
 */
final readonly class YamlConfigLoader implements ConfigLoader
{
    public function loader(ContainerBuilder $containerBuilder, SplFileInfo $configFile): YamlFileLoader
    {
        if (!$configFile->isReadable()) {
            throw new ConfigFileIsUnreadable($configFile);
        }

        return new YamlFileLoader(
            $containerBuilder,
            new FileLocator($configFile->getPathInfo()->getRealPath()),
        );
    }
}
