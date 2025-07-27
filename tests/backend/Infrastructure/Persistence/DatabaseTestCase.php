<?php

namespace Tests\backend\Infrastructure\Persistence;

use PHPUnit\Framework\TestCase;
use PDO;

abstract class DatabaseTestCase extends TestCase
{
    protected PDO $pdo;

    protected function setUp(): void
    {
        $dbHost = $_ENV['MYSQL_HOST'] ?? 'localhost';
        $dbName = $_ENV['MYSQL_DB'].'_test' ?? 'barkochba_test';
        $this->pdo = new PDO(
            "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4",
            $_ENV['MYSQL_USER'],
            $_ENV['MYSQL_PASSWORD'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
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
        $this->pdo->exec("INSERT INTO games (id, user_id, start_date, end_date, category, score) VALUES (2, 1, '2025-07-21 12:00:15', '2025-07-21 12:10:10', 'object', 45)");
        $this->pdo->exec("INSERT INTO questions (id, game_id, question, answer) VALUES (1, 1, 'Is it live beeing?', 0)");
    }

    protected function deleteAll()
    {
        $this->pdo->exec('DELETE FROM users;');
    }
}
