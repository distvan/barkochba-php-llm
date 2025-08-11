<?php

namespace Tests\backend\Http\Controllers;

use Tests\backend\BaseTestCase;
use App\Http\Controllers\GameController;
use App\Infrastructure\Persistence\GameRepository;
use App\Domain\Contracts\Storage as StorageInterface;
use App\Application\Contracts\AIAssistant as AIAssistantInterface;
use App\Domain\Shared\Category\CategoryEnum;
use Tests\backend\Helpers\MockingTrait;
use Nyholm\Psr7\Response;
use PDO;

class GameControllerTest extends BaseTestCase
{
    use MockingTrait;
    protected GameRepository $gameRepository;
    protected StorageInterface $storage;
    protected AIAssistantInterface $aiAssistant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gameRepository = new GameRepository($this->container->get(PDO::class));
        $this->storage = $this->container->get(StorageInterface::class);
        $this->aiAssistant = $this->container->get(AIAssistantInterface::class);
    }

    public function testIsInValidCategory(): void
    {
        $className = get_class($this->container->get(AIAssistantInterface::class));
        $mock = $this->mock($className);
        $mock->expects($this->never())
            ->method('suggestWord');
        /** @var AIAssistantInterface $mock */
        $controller = new GameController($this->gameRepository, $this->storage, $mock);
        $this->request = $this->request->withParsedBody(['category' => 'notexistingcategory']);
        /** @var Response $response */
        $response = $controller($this->request);
        $body = (string) $response->getBody();
        $data = json_decode($body, true);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertJson($body);
        $this->assertEquals('Invalid category', $data['error']);
    }

    public function testInvoke(): void
    {
        $className = get_class($this->container->get(AIAssistantInterface::class));
        $mock = $this->mock($className);
        $mock->expects($this->once())
            ->method('suggestWord')
            ->willReturn('vehicle');
        /** @var AIAssistantInterface $mock */
        $controller = new GameController($this->gameRepository, $this->storage, $mock);
         $this->request = $this->request->withParsedBody(['category' => CategoryEnum::OBJECT->value]);
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
