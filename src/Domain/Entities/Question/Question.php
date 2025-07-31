<?php

declare(strict_types=1);

namespace App\Domain\Entities\Question;

/**
 * Question Entity Class
 *
 * @package App\Domain\Entities
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class Question
{
    /**
     * Constructor
     *
     * @param integer $id
     * @param integer $gameId
     * @param string $question
     * @param boolean $answer
     */
    public function __construct(
        private int $id,
        private int $gameId,
        private string $question,
        private bool $answer
    ) {
    }

    /**
     * getId
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * getGameId
     *
     * @return integer
     */
    public function getGameId(): int
    {
        return $this->gameId;
    }

    /**
     * getQuestion
     *
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * getAnswer
     *
     * @return boolean
     */
    public function getAnswer(): bool
    {
        return $this->answer;
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
