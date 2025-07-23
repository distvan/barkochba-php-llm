<?php

namespace Tests\backend\Infrastructure\Persistence;

use App\Domain\Game\GameCollection;
use App\Infrastructure\Persistence\GameRepository;
use Tests\backend\Infrastructure\Persistence\DatabaseTestCase;

class GameRepositoryTest extends DatabaseTestCase
{
    public function testFindHighestScoredGamesWhenExist(): void
    {
        $repository = new GameRepository($this->pdo);
        $collection = $repository->findHighestScoredGames();
        $this->assertInstanceOf(GameCollection::class, $collection);
        $this->assertEquals(2, $collection->count());
    }

    public function testFindHighestScoredGamesWhenNotExist(): void
    {
        $this->deleteAll();
        $repository = new GameRepository($this->pdo);
        $collection = $repository->findHighestScoredGames();
        $this->assertInstanceOf(GameCollection::class, $collection);
        $this->assertEquals(0, $collection->count());
    }
}
