<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Bundle\Exception;

use RuntimeException;
use Shrikeh\ApiContext\Exception\Message;
use SplFileInfo;

final class ConfigFileIsUnreadable extends RuntimeException
{
    public const Message MSG = Message::BUNDLE_CONFIG_FILE_UNREADABLE;

    public function __construct(public readonly SplFileInfo $configFile)
    {
        parent::__construct(self::MSG->message($configFile->getPathname()));
    }
}