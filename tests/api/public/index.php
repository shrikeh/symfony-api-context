<?php
// phpcs:ignoreFile
declare(strict_types=1);

use Api\Http\Kernel;
use Shrikeh\ApiContext\Context\Http;

defined('APP_ROOT_DIR_LEVELS') || define('APP_ROOT_DIR_LEVELS', 1);

defined('APP_ROOT_DIR') || define('APP_ROOT_DIR', dirname(__DIR__, APP_ROOT_DIR_LEVELS));

require_once dirname(__DIR__, 2) . '/../vendor/autoload_runtime.php';

return new Http(APP_ROOT_DIR);