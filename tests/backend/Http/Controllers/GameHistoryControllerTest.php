<?php

namespace Tests\backend\Http\Controllers;

use Tests\backend\BaseTestCase;
use App\Http\Controllers\GameHistoryController;
use App\Infrastructure\Persistence\GameRepository;
use Nyholm\Psr7\Response;
use PDO;

class GameHistoryControllerTest extends BaseTestCase
{
    protected $gameRepository;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->gameRepository = new GameRepository($this->container->get(PDO::class));
    }

    public function testInvoke(): void
    {
        $controller = new GameHistoryController($this->gameRepository);
        /** @var Response $response */
        $response = $controller($this->request);
        $body = (string) $response->getBody();
        $data = json_decode($body, true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertJson($body);
        $this->assertIsArray($data);
        $this->assertCount(2, $data);
    }
}
