<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Console\Action;

use Symfony\Component\Console\Input\InputDefinition;

/**
 * @author Barney Hanlon <symfony@shrikeh.net>
 */
interface ConfigurableAction
{
    public function getDefinition(): InputDefinition;

    public function setDefinition(InputDefinition $definition): static;
}
