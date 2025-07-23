<?php

declare(strict_types=1);

namespace App\Domain\Game;

use App\Domain\Entities\Game;
use ArrayIterator;
use IteratorAggregate;

/**
 * GameCollection Class
 *
 * @package App\Domain\Game
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class GameCollection implements IteratorAggregate
{
    /**
     * Constructor
     *
     * @param Game[] $games
     */
    public function __construct(
        /** @var Game[] */
        private array $games
    ) {
    }

    /**
     * getIterator
     *
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->games);
    }

    /**
     * Count
     * Get the count of games
     *
     * @return integer
     */
    public function count():int
    {
        return count($this->games);
    }
}
