<?php

declare(strict_types=1);

interface Configurator
{
    public function __invoke(ConfigurableAction $consoleAction): ConfigurableAction;
}
