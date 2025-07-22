<?php

declare(strict_types=1);

namespace App\Domain\Shared\Factory;

use App\Domain\Shared\Contracts\NullObject as NullObjectInterface;

class NullObjectFactory
{
    public static function get(string $class): NullObjectInterface
    {
        return $class::getInstance();
    }
}
