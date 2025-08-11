<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Contracts\GameRepository as GameRepositoryInterface;
use App\Domain\Entities\Game\Game;
use App\Domain\Entities\Game\NullGame;
use App\Domain\Factories\GameFactory;
use App\Domain\Shared\Factory\NullObjectFactory;
use App\Domain\Game\GameCollection;
use DateTime;
use PDO;
use PDOException;

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
        $stmt = $this->pdo->prepare('SELECT * FROM games WHERE end_date IS NOT NULL ORDER BY score DESC LIMIT :limit');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $games[] = GameFactory::fromRow($row);
        }

        return new GameCollection($games);
    }

    /**
     * Create a new game
     *
     * @param integer $userId
     * @param string $category
     * @param string $targetWord
     * @throws PDOException
     * @return integer gameId
     */
    public function createNewGame(int $userId, string $category, string $targetWord): int
    {
        $now = new DateTime();
        try{
            $stmt = $this->pdo->prepare('INSERT INTO games (user_id, start_date, category, target_word) VALUES (:user_id, :start_date, :category, :target_word)');
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':start_date', $now->format('Y-m-d H:i:s'), PDO::PARAM_STR);
            $stmt->bindValue(':category', $category, PDO::PARAM_STR);
            $stmt->bindValue(':target_word', $targetWord, PDO::PARAM_STR);
            $stmt->execute();
            return (int)$this->pdo->lastInsertId();
        } catch (PDOException $e) {
            return 0;
        }
    }

    /**
     * getLatestUnfinishedGame
     *
     * @return Game|NullGame
     */
    public function getLatestUnfinishedGame(int $userId): Game|NullGame
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM games WHERE end_date IS NULL AND user_id=:user_id ORDER BY id DESC LIMIT 1');
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row) {
                $game = GameFactory::fromRow($row);
            } else {
                $game = NullObjectFactory::get(NullGame::class);
            }
        } catch (PDOException $e) {
            $game = NullObjectFactory::get(NullGame::class);
        }

        return $game;
    }

    /**
     * End the game
     *
     * @param integer $gameId
     * @param integer $score
     * @return boolean
     */
    public function endGame(int $gameId, int $score): bool
    {
        $now = new DateTime();
        try {
            $stmt = $this->pdo->prepare('UPDATE games SET end_date=:end_date, score=:score WHERE id=:game_id');
            $stmt->bindValue(':end_date', $now->format('Y-m-d H:i:s'), PDO::PARAM_STR);
            $stmt->bindValue(':score', $score, PDO::PARAM_INT);
            $stmt->bindValue(':game_id', $gameId, PDO::PARAM_INT);
            return $stmt->execute();
        }
        catch (PDOException $e) {
            return false;
        }
    }
}
