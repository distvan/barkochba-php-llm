<?php

declare(strict_types=1);

namespace App\Domain\Entities\User;

use App\Domain\Shared\Entity\NullEntity;

/**
 * NullUser Entity Class
 *
 * @package App\Domain\Entities
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class NullUser extends NullEntity
{
    private static ?self $instance = null;

    public static function getInstance(): self {
        return self::$instance ??= new self();
    }

    public function getId(): ?int {
        return null;
    }

    public function getName(): string {
        return '';
    }
    
    //No need for singleton logic anymore
    protected function __construct() {}
}
