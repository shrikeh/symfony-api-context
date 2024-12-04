<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Kernel;

enum Service: string
{

    case KERNEL = 'kernel';
    case KERNEL_ENVIRONMENT = 'kernel.environment';

    case KERNEL_DEBUG = 'kernel.debug';
    case KERNEL_BUNDLES = 'kernel.bundles';

    case KERNEL_CONFIG_DIR = 'kernel.config_dir';

    case KERNEL_BUNDLES_PATH = 'kernel.bundles.path';

    case BUNDLE_SERVICE_LOCATOR = 'bundle.service_locator';
    case EXTENSION_SERVICE_LOCATOR = 'console_extension.service_locator';

    case CONFIG_FILE_INFO = 'config.file_info';
    case CONFIG_FILE_PATH = 'config.file_path';

    case PROJECT_DIR_PATH = 'project.dir_path';

    public function key(): string
    {
        return $this->value;
    }
}
