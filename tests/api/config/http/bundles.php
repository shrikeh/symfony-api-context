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

use Shrikeh\ApiContext\Http\Bundle as Http;
use Shrikeh\ApiContext\Kernel\DefaultKernel;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;

return [
    FrameworkBundle::class => [DefaultKernel::ENVS_ALL => true],
    Http::class  => [DefaultKernel::ENVS_ALL => true],
    TwigBundle::class => [DefaultKernel::ENVS_ALL => true],
];
