<?php

namespace Tests\backend\Http\Controllers;

use Tests\backend\BaseTestCase;
use App\Http\Controllers\GameHistoryController;
use App\Infrastructure\Persistence\GameRepository;
use App\Infrastructure\Persistence\UserRepository;
use Nyholm\Psr7\Response;
use PDO;

class GameHistoryControllerTest extends BaseTestCase
{
    protected $gameRepository;
    protected $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gameRepository = new GameRepository($this->container->get(PDO::class));
        $this->userRepository = new UserRepository($this->container->get(PDO::class));
    }

    public function testInvoke(): void
    {
        $controller = new GameHistoryController($this->gameRepository, $this->userRepository);
        /** @var Response $response */
        $response = $controller($this->request);
        $body = (string) $response->getBody();
        $data = json_decode($body, true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertJson($body);
        $this->assertIsArray($data);
        $this->assertCount(1, $data);
        $this->assertEquals(40, $data[0]['score']);
    }
}
