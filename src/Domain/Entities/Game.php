<?php

declare(strict_types=1);

namespace App\Domain\Entities;

/**
 * Game Class
 *
 * @package App\Domain\Entities
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class Game
{
    public function __construct(
        private int $id,
        private int $userId,
        private string $startDate,
        private string $endDate,
        private int $score
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }

    public function getScore(): int
    {
        return $this->score;
    }
}
