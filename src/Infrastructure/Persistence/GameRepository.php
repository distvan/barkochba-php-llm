<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Contracts\GameRepository as GameRepositoryInterface;
use App\Domain\Entities\Game;
use App\Domain\Game\GameCollection;
use PDO;

/**
 * GameRepository class
 *
 * @package App\Infrastructure\Persistence
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class GameRepository implements GameRepositoryInterface
{
    /**
     * Construct
     *
     * @param PDO $pdo
     */
    public function __construct(private PDO $pdo) {}

    /**
     * findHighestScoredGames
     *
     * @param integer $limit
     * @return GameCollection
     */
    public function findHighestScoredGames(int $limit = 10): GameCollection
    {
        $games = [];
        $stmt = $this->pdo->prepare('SELECT * FROM games ORDER BY score DESC LIMIT :limit');
        $stmt->execute(['limit' => $limit]);
        while ($row = $stmt->fetch()) {
            $games[] = new Game(
                id: (int)$row['id'],
                userId: (int)$row['user_id'],
                startDate: $row['start_date'],
                endDate: $row['end_date'],
                score: (int)$row['score']
            );
        }

        return new GameCollection($games);
    }
}
