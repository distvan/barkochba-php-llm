<?php

declare(strict_types=1);

namespace App\Domain\Entities;

/**
 * Question Class
 *
 * @package App\Domain\Entities
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class Question
{
    public function __construct(
        private int $id,
        private int $gameId,
        private string $question,
        private bool $answer
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getGameId(): int
    {
        return $this->gameId;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getAnswer(): bool
    {
        return $this->answer;
    }
}
