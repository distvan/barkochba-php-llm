<?php

namespace Tests\backend\Http\Controllers;

use Tests\backend\BaseTestCase;
use App\Http\Controllers\GameEndController;
use App\Infrastructure\Persistence\GameRepository;
use App\Domain\Contracts\Storage as StorageInterface;
use Nyholm\Psr7\Response;
use PDO;

class GameEndControllerTest extends BaseTestCase
{
    protected GameRepository $gameRepository;
    protected StorageInterface $storage;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gameRepository = new GameRepository($this->container->get(PDO::class));
        $this->storage = $this->container->get(StorageInterface::class);
    }

    public function testInvokeWithCorrectGuess(): void
    {
        $this->storage->save('game_id', 1);
        $this->storage->save('target_word', 'vehicle');
        $controller = new GameEndController($this->gameRepository, $this->storage);
        $this->request = $this->request->withParsedBody(['guessedWord' => 'vehicle']);
        /** @var Response $response */
        $response = $controller($this->request);
        $body = (string) $response->getBody();
        $data = json_decode($body, true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertJson($body);
        $this->assertTrue($data['ok']);
        $this->assertEquals('Congratulations! You guessed the word.', $data['message']);
        $this->assertEquals(1, $data['gameId']);
    }

    public function testInvokeWithInCorrectGuess(): void
    {
        $this->storage->save('game_id', 1);
        $this->storage->save('target_word', 'gibberish');
        $controller = new GameEndController($this->gameRepository, $this->storage);
        $this->request = $this->request->withParsedBody(['guessedWord' => 'truck']);
        /** @var Response $response */
        $response = $controller($this->request);
        $body = (string) $response->getBody();
        $data = json_decode($body, true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertJson($body);
        $this->assertTrue($data['result'] === '');
    }
}
