<?php

declare(strict_types=1);

namespace App\Domain\Game;

use App\Domain\Entities\Question\Question;
use ArrayIterator;
use IteratorAggregate;

/**
 * QuestionCollection Class
 *
 * @package App\Domain\Game
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class QuestionCollection implements IteratorAggregate
{
    /**
     * Constructor
     *
     * @param Question[] $questions
     */
    public function __construct(
        /** @var Question[] */
        private array $questions
    ){
    }

    /**
     * getIterator
     *
     * @return ArrayIterator<int, Question>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->questions);
    }

    /**
     * Count
     * Get the count of questions
     *
     * @return integer
     */
    public function count():int
    {
        return count($this->questions);
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_map(fn($question) => $question->toArray(), $this->questions);
    }
}
