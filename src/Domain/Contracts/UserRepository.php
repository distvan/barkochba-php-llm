<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

use App\Domain\Entities\User\NullUser;
use App\Domain\Entities\User\User;

/**
 * UserRepository Interface
 *
 * @package App\Domain\Contracts
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
interface UserRepository
{
    public function findById(int $userId): User|NullUser;
}
