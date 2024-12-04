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

namespace Shrikeh\ApiContext\Factory\ConfigLoader\Exception;

use RuntimeException;
use Shrikeh\ApiContext\Exception\Message;
use SplFileInfo;

/**
 * @author Barney Hanlon <symfony@shrikeh.net>
 */
final class ConfigFileIsUnreadable extends RuntimeException implements ConfigLoaderException
{
    public const Message MSG = Message::CONFIG_FILE_UNREADABLE;

    public function __construct(public readonly SplFileInfo $configFile)
    {
        parent::__construct(self::MSG->message($configFile->getPathname()));
    }
}
