<?php

declare(strict_types=1);

namespace App\Domain\Entities\Game;

use App\Domain\Shared\Entity\NullEntity;

/**
 * NullQuestion Entity Class
 *
 * @package App\Domain\Entities\Question
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class NullGame extends NullEntity
{
    private static ?self $instance = null;

    public static function getInstance(): self {
        return self::$instance ??= new self();
    }

    public function getId(): ?int {
        return null;
    }

    public function getUserId(): ?int {
        return null;
    }
    
    public function getCategory(): string {
        return '';
    }

    public function getStartDate(): ?string {
        return null;
    }

    public function getEndDate(): ?string {
        return null;
    }

    public function getScore(): int {
        return 0;
    }

    //No need for singleton logic anymore
    protected function __construct() {}
}
