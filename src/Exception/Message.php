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

namespace Shrikeh\ApiContext\Exception;


/**
 * @author Barney Hanlon <symfony@shrikeh.net>
 */
enum Message: string
{
    case CONFIG_FILE_UNREADABLE = 'Config file %s is unreadable.';
    case INPUT_CONFIGURATOR_NO_INPUTS = 'An input configurator must have at least one input.';
    case ERROR_BUILDING_QUERY = 'An error occurred building the query: %s';
    case ERROR_RENDERING_RESULT = 'An error occurred rendering the result: %s';
    case INPUT_FAILED_VALIDATION = 'Required input failed validation';
    case NO_INPUTS_PASSED = 'No inputs were passed';
    case OUTPUT_FORMATTER_UNSUPPORTED_RESULT = 'The result type %s is not supported. Supported types are: %s.';
    case SERVICE_NOT_FOUND = 'The service locator did not have the service with identifier "%s"';
    case BUNDLE_CONFIG_FILE_UNREADABLE = 'The config file %s is not readable.';

    public function message(string ...$args): string
    {
        return sprintf($this->value, ...$args);
    }
}
