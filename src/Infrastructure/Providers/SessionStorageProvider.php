<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Domain\Contracts\Storage as StorageInterface;
use App\Shared\Contracts\ServiceProvider;
use App\Shared\Logging\LoggerFactory;
use App\Storage\SessionStorage;
use Psr\Container\ContainerInterface;

class SessionStorageProvider implements ServiceProvider
{
    public function register(ContainerInterface $container): void
    {
        if (method_exists($container, 'bind')) {
            $container->bind(StorageInterface::class, function() {
                return new SessionStorage(LoggerFactory::create('session_storage'));
            });
        }
    }
}
