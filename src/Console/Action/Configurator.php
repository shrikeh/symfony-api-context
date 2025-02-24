<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Console\Action;

interface Configurator
{
    public function __invoke(ConfigurableAction $consoleAction): ConfigurableAction;
}
