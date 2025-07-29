<?php

namespace App\Domain\Factories;

use App\Domain\Entities\Game\Game;

/**
 * GameFactory class
 *
 * @package App\Domain\Factories
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class GameFactory
{
    /**
     * fromRow
     *
     * @param array $row
     * @return Game
     */
    public static function fromRow(array $row): Game
    {
        return new Game(
            id: (int)$row['id'],
            userId: (int)$row['user_id'],
            category: $row['category'] ?? '',
            targetWord: $row['target_word'] ?? '',
            startDate: $row['start_date'],
            endDate: $row['end_date'] ?? '',
            score: (int)$row['score']
        );
    }
}
