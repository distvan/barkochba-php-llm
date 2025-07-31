<?php

namespace Tests\backend\Http\Controllers;

use Tests\backend\BaseTestCase;
use App\Http\Controllers\GameController;
use App\Infrastructure\Persistence\GameRepository;
use Nyholm\Psr7\Response;
use PDO;

class GameControllerTest extends BaseTestCase
{
    protected $gameRepository;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->gameRepository = new GameRepository($this->container->get(PDO::class));
    }

    public function testInvoke(): void
    {
        $controller = new GameController($this->gameRepository);
        /** @var Response $response */
        $response = $controller($this->request);
        $body = (string) $response->getBody();
        $data = json_decode($body, true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertJson($body);
        $this->assertEquals('started', $data['result']);
    }
}
