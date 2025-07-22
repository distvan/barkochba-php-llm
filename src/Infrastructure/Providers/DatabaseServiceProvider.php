<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Shared\Contracts\ServiceProvider;
use Psr\Container\ContainerInterface;
use PDO;

class DatabaseServiceProvider implements ServiceProvider
{
    public function register(ContainerInterface $container): void
    {
        if (method_exists($container, 'bind')) {
            $container->bind(PDO::class, function() {
                $dbHost = $_ENV['MYSQL_HOST'] ?? 'localhost';
                $dbName = $_ENV['MYSQL_DB'] ?? 'barkochba';
                return new PDO(
                    "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4",
                    $_ENV['MYSQL_USER'],
                    $_ENV['MYSQL_PASSWORD'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            });
        }
    }
}
