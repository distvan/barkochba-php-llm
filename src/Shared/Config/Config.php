<?php

declare(strict_types=1);

namespace App\Shared\Config;

/**
 * Config class
 *
 * @package App\Shared
 */
class Config
{
    private array $providers;

    public function __construct()
    {
        $this->providers = [
            \App\Infrastructure\Providers\DatabaseServiceProvider::class,
            \App\Infrastructure\Providers\AIAssistantServiceProvider::class,
            \App\Infrastructure\Providers\SessionStorageProvider::class,
        ];
    }

    public function getProviders() {
        return $this->providers;
    }
}
