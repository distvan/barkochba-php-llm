<?php

declare(strict_types=1);

namespace App\Domain\Shared\Contracts;

interface NullObject
{
    public function isNull(): bool;
}
