<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

use App\Domain\Entities\Game\Game;
use App\Domain\Entities\Game\NullGame;
use App\Domain\Game\GameCollection;

/**
 * GameRepository Interface
 *
 * @package App\Domain\Contracts
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
interface GameRepository
{
    public function findHighestScoredGames(int $limit = 10): GameCollection;
    public function createNewGame(int $userId, string $category): int;
    public function getLatestUnfinishedGame(int $userId): Game|NullGame;
}
