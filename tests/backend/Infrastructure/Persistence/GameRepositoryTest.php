<?php

namespace Tests\backend\Infrastructure\Persistence;

use App\Domain\Entities\Game\Game;
use App\Domain\Entities\Game\NullGame;
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

    public function testGetLatestUnfinishedGame(): void
    {
        $game = $this->gameRepository->getLatestUnfinishedGame();
        $this->assertInstanceOf(Game::class, $game);
        $this->assertEquals($game->getCategory(), 'object');
        $this->assertEquals($game->getTargetWord(), 'vehicle');
        $this->assertEquals($game->getId(), 2);
        $this->assertEquals($game->getUserId(), 1);
        $this->assertEquals($game->getScore(), 45);
    }

    public function testGetLatestUnfinishedGameWithEmptyResult(): void
    {
        $this->deleteAll();
        $game = $this->gameRepository->getLatestUnfinishedGame();
        $this->assertInstanceOf(NullGame::class, $game);
        $this->assertNull($game->getId());
        $this->assertNull($game->getUserId());
        $this->assertNull($game->getStartDate());
        $this->assertNull($game->getEndDate());
        $this->assertEmpty($game->getScore());
        $this->assertEmpty($game->getCategory());
        $this->assertEmpty($game->getTargetWord());
    }
}
