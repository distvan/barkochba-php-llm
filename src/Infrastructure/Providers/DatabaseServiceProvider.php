<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Shared\Contracts\ServiceProvider;
use Psr\Container\ContainerInterface;

class DatabaseServiceProvider implements ServiceProvider
{
    public function register(ContainerInterface $container): void
    {

    }
}