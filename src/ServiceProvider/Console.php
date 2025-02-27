<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\ServiceProvider;

use Generator;
use Psr\Container\ContainerInterface;
use Shrikeh\ApiContext\Bundle\Factory\ConfigLoader;
use Shrikeh\ApiContext\Bundle\Factory\ConfigLoader\YamlConfigLoader;
use Shrikeh\ApiContext\Container\Psr11ServiceLocator;
use Shrikeh\ApiContext\Console\Bundle;
use Shrikeh\ApiContext\Console\DependencyInjection\ConsoleExtension;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Shrikeh\ApiContext\Kernel\Service;
use SplFileInfo;
use Shrikeh\ApiContext\Kernel\DefaultKernel as Kernel;

final readonly class Console implements ServiceProviderInterface
{
    public function __construct(
        private string $projectDir,
        private string $environment,
        private bool $debug,
    ) {
    }

    /**
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function register(Container $pimple): void
    {
        $pimple[Bundle::class] = static function (Container $con): Bundle {
            return new Bundle(
                serviceLocator: $con[Service::BUNDLE_SERVICE_LOCATOR->key()],
                name: Bundle::DEFAULT_BUNDLE_NAME,
            );
        };

        $pimple[Service::CONFIG_FILE_INFO->key()] = static function (Container $con): SplFileInfo {
            return new SplFileInfo(
                sprintf(
                    '%s/%s',
                    $con[Service::PROJECT_DIR_PATH->key()],
                    $con[Service::CONFIG_FILE_PATH->key()],
                )
            );
        };

        $pimple[Service::PROJECT_DIR_PATH->key()] = $this->projectDir;

        $pimple[Service::CONFIG_FILE_PATH->key()] = 'config/console/services.yaml';

        $pimple[ConsoleExtension::class] = static function (Container $con): ConsoleExtension {
            return new ConsoleExtension(
                consoleConfig: $con[Service::CONFIG_FILE_INFO->key()],
                serviceLocator: $con[Service::EXTENSION_SERVICE_LOCATOR->key()],
            );
        };

        $pimple[Service::BUNDLE_SERVICE_LOCATOR->key()] = static function (Container $con): ContainerInterface {
            return new Psr11ServiceLocator($con, [
                ConsoleExtension::class,
            ]);
        };

        $pimple[Service::EXTENSION_SERVICE_LOCATOR->key()] = static function (Container $con): ContainerInterface {
            return new Psr11ServiceLocator($con, [
                ConfigLoader::class => YamlConfigLoader::class,
            ]);
        };

        $pimple[YamlConfigLoader::class] = static function (): YamlConfigLoader {
            return new YamlConfigLoader();
        };

        $pimple[Service::KERNEL_CONFIG_DIR->key()] = sprintf(
            '%s/config/console',
            $pimple[Service::PROJECT_DIR_PATH->key()],
        );

        $pimple[Service::KERNEL_BUNDLES_PATH->key()] = static function (Container $con): string {
            return sprintf(
                '%s/bundles.php',
                $con[Service::KERNEL_CONFIG_DIR->key()],
            );
        };

        $pimple[Service::KERNEL_BUNDLES->key()] = static function (Container $con): array {
            $contents = require $con[Service::KERNEL_BUNDLES_PATH->key()];
            $environment = $con[Service::KERNEL_ENVIRONMENT->key()];
            $bundles = [];
            foreach ($contents as $class => $envs) {
                if ($envs[$environment] ?? $envs[Kernel::ENVS_ALL] ?? false) {
                    if ($con->offsetExists($class)) {
                        $bundles[$class] = $con[$class];
                    } else {
                        $bundles[$class] = new $class();
                    }
                }
            }
            return $bundles;
        };

        $pimple[Service::KERNEL->key()] = static function (Container $con): Kernel {

            return new Kernel(
                $con[Psr11ServiceLocator::class],
                $con[Service::KERNEL_ENVIRONMENT->key()],
                $con[Service::KERNEL_DEBUG->key()],
            );
        };

        $pimple[Service::KERNEL_ENVIRONMENT->key()] = $this->environment;
        $pimple[Service::KERNEL_DEBUG->key()] = $this->debug;

        $pimple[Psr11ServiceLocator::class] = static function (Container $con): Psr11ServiceLocator {
            $services = array_map(static function (Service $service): string {
                return $service->key();
            }, [
                Service::KERNEL_BUNDLES,
                Service::KERNEL_BUNDLES_PATH,
                Service::KERNEL_CONFIG_DIR,
                Service::PROJECT_DIR_PATH,
            ]);

            return new Psr11ServiceLocator($con, $services);
        };
    }

}
