<?php

declare(strict_types=1);

namespace App\Domain\Entities;

/**
 * Game Entity Class
 *
 * @package App\Domain\Entities
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class Game
{
    /**
     * Constructor
     *
     * @param integer $id
     * @param integer $userId
     * @param string $startDate
     * @param string $endDate
     * @param integer $score
     */
    public function __construct(
        private int $id,
        private int $userId,
        private string $startDate,
        private string $endDate,
        private int $score
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
     * getUserId
     *
     * @return integer
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * getStartDate
     *
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * getEndDate
     *
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * getScore
     *
     * @return integer
     */
    public function getScore(): int
    {
        return $this->score;
    }
}
