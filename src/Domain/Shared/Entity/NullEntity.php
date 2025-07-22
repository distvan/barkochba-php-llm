<?php

declare(strict_types=1);

namespace App\Domain\Shared\Entity;

use App\Domain\Shared\Contracts\NullObject as NullObjectInterface;

abstract class NullEntity implements NullObjectInterface
{
    public function isNull(): bool {
        return true;
    }
}
