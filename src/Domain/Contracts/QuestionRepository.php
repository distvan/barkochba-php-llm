<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

use App\Domain\Game\QuestionCollection;

/**
 * QuestionRepository Interface
 *
 * @package App\Domain\Contracts
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
interface QuestionRepository
{
    public function findQuestionsByGameId(int $gameId): QuestionCollection;
    public function saveQuestion(int $gameId, string $question, int $answer): int;
}
