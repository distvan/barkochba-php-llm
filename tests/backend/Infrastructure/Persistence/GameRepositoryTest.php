<?php

namespace Tests\backend\Infrastructure\Persistence;

use App\Domain\Game\GameCollection;
use App\Infrastructure\Persistence\GameRepository;
use Tests\backend\Infrastructure\Persistence\DatabaseTestCase;

class GameRepositoryTest extends DatabaseTestCase
{
    private GameRepository $gameRepository;
    public function setUp():void {
        parent::setUp();
        $this->gameRepository = new GameRepository($this->pdo);
    }
    public function testFindHighestScoredGamesWhenExist(): void
    {
        $collection = $this->gameRepository->findHighestScoredGames();
        $this->assertInstanceOf(GameCollection::class, $collection);
        $this->assertEquals(2, $collection->count());
    }

    public function testFindHighestScoredGamesWhenNotExist(): void
    {
        $this->deleteAll();
        $collection = $this->gameRepository->findHighestScoredGames();
        $this->assertInstanceOf(GameCollection::class, $collection);
        $this->assertEquals(0, $collection->count());
    }

    public function testCreatingNewGameWithSuccess(): void
    {
        $gameId = $this->gameRepository->createNewGame(1, 'object');
        $this->assertGreaterThan(0, $gameId);
    }
}
