<?php

namespace Tests\backend;

use PHPUnit\Framework\TestCase;
use App\Shared\Config\Config;
use App\Infrastructure\Container\Container;
use App\Infrastructure\Kernel\Kernel;
use Nyholm\Psr7Server\ServerRequestCreator;
use Nyholm\Psr7\Factory\Psr17Factory;
use PDO;

abstract class BaseTestCase extends TestCase
{
    protected $request;
    protected $container;
    protected PDO $pdo;
    
    protected function setUp(): void
    {
        $path = dirname(__DIR__, 4) . '/src/Shared/Config';
        $config = new Config($path);
        $this->container = new Container();
        $kernel = new Kernel($this->container);
        $kernel->registerProviders($config->getProviders());
        $psr17 = new Psr17Factory();
        $this->request = (new ServerRequestCreator($psr17, $psr17, $psr17, $psr17))->fromGlobals();
        $this->pdo = $this->container->get(PDO::class);
        $this->deleteAll();
        $this->seed();
        $this->pdo->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->pdo->rollBack();
    }

    protected function seed(): void
    {
        $this->pdo->exec("INSERT INTO users (id, name) VALUES (1, 'Test')");
        $this->pdo->exec("INSERT INTO games (id, user_id, start_date, end_date, category, score) VALUES (1, 1, '2025-07-21 10:00:15', '2025-07-21 11:10:10', 'object', 40)");
        $this->pdo->exec("INSERT INTO games (id, user_id, start_date, category, target_word, score) VALUES (2, 1, '2025-07-21 12:00:15', 'object', 'vehicle', 45)");
        $this->pdo->exec("INSERT INTO questions (id, game_id, question, answer) VALUES (1, 1, 'Is it live beeing?', 0)");
    }

    protected function deleteAll()
    {
        $this->pdo->exec('DELETE FROM users;');
    }
}
