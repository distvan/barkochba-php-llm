<?php

declare(strict_types=1);

namespace App\Domain\Entities\Question;

use App\Domain\Shared\Entity\NullEntity;

/**
 * NullQuestion Entity Class
 *
 * @package App\Domain\Entities\Question
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class NullQuestion extends NullEntity
{
    private static ?self $instance = null;

    public static function getInstance(): self {
        return self::$instance ??= new self();
    }

    public function getId(): ?int {
        return null;
    }

    public function getGameId(): ?int {
        return null;
    }
    
    public function getQuestion(): string {
        return '';
    }

    public function getAnswer(): bool {
        return false;
    }

    //No need for singleton logic anymore
    protected function __construct() {}
}
