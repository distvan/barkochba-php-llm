<?php

namespace Tests\backend\Http\Controllers;

use Tests\backend\BaseTestCase;
use App\Http\Controllers\GamePendingController;
use App\Infrastructure\Persistence\GameRepository;
use App\Infrastructure\Persistence\QuestionRepository;
use App\Domain\Contracts\Storage as StorageInterface;
use Nyholm\Psr7\Response;
use PDO;

class GamePendingControllerTest extends BaseTestCase
{
    protected GameRepository $gameRepository;
    protected QuestionRepository $questionRepository;
    protected StorageInterface $storage;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gameRepository = new GameRepository($this->container->get(PDO::class));
        $this->questionRepository = new QuestionRepository($this->container->get(PDO::class));
        $this->storage = $this->container->get(StorageInterface::class);
        $this->storage->clear();
    }

    public function testInvoke(): void
    {
        $controller = new GamePendingController($this->gameRepository, $this->questionRepository, $this->storage);
        /** @var Response $response */
        $response = $controller($this->request);
        $body = (string) $response->getBody();
        $data = json_decode($body, true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertJson($body);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('result', $data);
        $this->assertArrayHasKey('category', $data['result']);
        $this->assertArrayHasKey('questions', $data['result']);
    }
}
