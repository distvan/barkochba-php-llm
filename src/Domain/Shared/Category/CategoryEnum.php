<?php

declare(strict_types=1);

namespace App\Domain\Shared\Category;

/**
 * CategoryEnum
 *
 * @package App\Domain\Shared\Category
 */
Enum CategoryEnum: string
{
    case ORGANISM = 'organism';
    case OBJECT = 'object';
    case CONCEPT = 'concept';
}
