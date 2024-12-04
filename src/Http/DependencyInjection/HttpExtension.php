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

namespace Shrikeh\ApiContext\Http\DependencyInjection;

use Nyholm\Psr7\Uri;
use Psr\Container\ContainerInterface;
use Shrikeh\ApiContext\Bundle\Exception\ConfigFileIsUnreadable;
use Shrikeh\ApiContext\Bundle\Extension\Traits\LoadConfig;
use Shrikeh\ApiContext\Bundle\Extension\Traits\XsdNamespace;
use SplFileInfo;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

/**
 * @author Barney Hanlon <symfony@shrikeh.net>
 */
final readonly class HttpExtension implements ExtensionInterface
{
    use LoadConfig;
    use XsdNamespace;

    public const string DEFAULT_ALIAS = 'api_http';

    public const string DEFAULT_NAMESPACE = 'https://symfony.shrikeh.net/schema/dic';

    public function __construct(
        private SplFileInfo $httpConfig,
        private ContainerInterface $serviceLocator,
        private string $alias = self::DEFAULT_ALIAS
    ) {
        if (!$this->httpConfig->isReadable()) {
            throw new ConfigFileIsUnreadable($this->httpConfig);
        }

        $this->namespace = new Uri(self::DEFAULT_NAMESPACE);
    }


    private function serviceLocator(): ContainerInterface
    {
        return $this->serviceLocator;
    }

    private function configPath(): SplFileInfo
    {
        return $this->httpConfig;
    }
}
