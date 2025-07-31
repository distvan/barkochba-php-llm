<?php

namespace Tests\backend\Http\Controllers;

use Tests\backend\BaseTestCase;
use App\Http\Controllers\GamePendingController;
use App\Infrastructure\Persistence\GameRepository;
use App\Infrastructure\Persistence\QuestionRepository;
use Nyholm\Psr7\Response;
use PDO;

class GamePendingControllerTest extends BaseTestCase
{
    protected $gameRepository;
    protected $questionRepository;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->gameRepository = new GameRepository($this->container->get(PDO::class));
        $this->questionRepository = new QuestionRepository($this->container->get(PDO::class));
    }

    public function testInvoke(): void
    {
        $controller = new GamePendingController($this->gameRepository, $this->questionRepository);
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
