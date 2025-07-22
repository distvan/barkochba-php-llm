<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Contracts\QuestionRepository as QuestionRepositoryInterface;
use App\Domain\Entities\Question;
use App\Domain\Game\QuestionCollection;
use PDO;

/**
 * QuestionRepository class
 *
 * @package App\Infrastructure\Persistence
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * Construct
     *
     * @param PDO $pdo
     */
    public function __construct(private PDO $pdo) {}

    public function findQuestionsByGameId(int $gameId): QuestionCollection
    {
        $questions = [];
        $stmt = $this->pdo->prepare('SELECT * FROM questions WHERE game_id=:game_id');
        $stmt->execute(['game_id' => $gameId]);
        while ($row = $stmt->fetch()) {
            $questions = new Question(
                id: (int)$row['id'],
                gameId: (int)$row['game_id'],
                question: $row['question'],
                answer: (bool)$row['answer']
            );
        }
        
        return new QuestionCollection($questions);
    }
}
