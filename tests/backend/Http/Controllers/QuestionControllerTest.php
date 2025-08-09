<?php

namespace Tests\backend\Http\Controllers;

use App\Application\Contracts\AIAssistant as AIAssistantInterface;
use App\Application\Services\AIAssistant;
use Tests\backend\BaseTestCase;
use App\Http\Controllers\QuestionController;
use App\Infrastructure\Persistence\QuestionRepository;
use App\Domain\Contracts\Storage as StorageInterface;
use App\Infrastructure\LLM\LLMClient;
use Nyholm\Psr7\Response;
use PDO;
use Tests\backend\Helpers\MockingTrait;

class QuestionControllerTest extends BaseTestCase
{
    use MockingTrait;
    protected QuestionRepository $questionRepository;
    protected StorageInterface $storage;
    protected AIAssistantInterface $aiAssistant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->questionRepository = new QuestionRepository($this->container->get(PDO::class));
        $this->storage = $this->container->get(StorageInterface::class);
        $this->aiAssistant = $this->container->get(AIAssistantInterface::class);
    }

    public function testInvoke(): void
    {
        $className = get_class($this->container->get(AIAssistantInterface::class));
        $mock = $this->mock($className);
        $mock->expects($this->once())
            ->method('askQuestion')
            ->willReturn('yes');
        /** @var AIAssistant $mock */
        $controller = new QuestionController($this->questionRepository, $this->storage, $mock);
        $this->request = $this->request->withParsedBody(['question' => "It's color is relevant?"]);
        /** @var Response $response */
        $response = $controller($this->request);
        $body = (string) $response->getBody();
        $data = json_decode($body, true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertJson($body);
        $this->arrayHasKey('ok', $data);
        $this->assertTrue($data['ok']);
        $this->assertArrayHasKey('questions', $data);
        $this->assertIsArray($data['questions']);
        $this->assertCount(1, $data['questions']);
    }
}
